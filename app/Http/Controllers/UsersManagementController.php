<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersManagementController extends Controller
{
    public function index()
    {
        $paginationEnabled = config('usersmanagement.enablePagination');
        $query = User::with('roles', 'profile');
        if ($paginationEnabled) {
            $users = $query->paginate(config('usersmanagement.paginateListSize'));
        } else {
            $users = $query->get();
        }
        $roles = Role::all();

        return View('usersmanagement.show-users', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('usersmanagement.create-user', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|unique:users|alpha_dash',
                'first_name' => 'nullable|alpha_dash',
                'last_name' => 'nullable|alpha_dash',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:8|max:128|confirmed',
                'password_confirmation' => 'required|same:password',
                'role' => 'required',
            ],
            [
                'name.unique' => trans('auth.userNameTaken'),
                'name.required' => trans('auth.userNameRequired'),
                'email.required' => trans('auth.emailRequired'),
                'email.email' => trans('auth.emailInvalid'),
                'password.required' => trans('auth.passwordRequired'),
                'password.min' => trans('auth.PasswordMin'),
                'password.max' => trans('auth.PasswordMax'),
                'role.required' => trans('auth.roleRequired'),
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => strip_tags($request->input('name')),
            'first_name' => strip_tags($request->input('first_name')),
            'last_name' => strip_tags($request->input('last_name')),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'token' => Str::random(64),
            'activated' => 1,
        ]);

        if (method_exists($user, 'setAdminIp')) {
            $user->setAdminIp()->save();
        }

        if (method_exists($user, 'ensureProfile')) {
            $user->ensureProfile();
        }

        $user->attachRole($request->input('role'));

        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));
    }

    public function show(User $user)
    {
        return view('usersmanagement.show-user', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $currentRole = $user->roles->first();

        return view('usersmanagement.edit-user', [
            'user' => $user,
            'roles' => $roles,
            'currentRole' => $currentRole,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $emailCheck = ($request->input('email') !== '') && ($request->input('email') !== $user->email);

        $rules = [
            'name' => 'required|max:255|alpha_dash|unique:users,name,'.$user->id,
            'first_name' => 'nullable|alpha_dash',
            'last_name' => 'nullable|alpha_dash',
            'password' => 'nullable|confirmed|min:8',
        ];

        if ($emailCheck) {
            $rules['email'] = 'email|max:255|unique:users';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = strip_tags($request->input('name'));
        $user->first_name = strip_tags($request->input('first_name'));
        $user->last_name = strip_tags($request->input('last_name'));

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($request->input('password') !== null) {
            $user->password = Hash::make($request->input('password'));
        }

        $userRole = $request->input('role');
        if ($userRole !== null) {
            $user->detachAllRoles();
            $user->attachRole($userRole);
        }

        if (method_exists($user, 'setUpdatedIp')) {
            $user->setUpdatedIp();
        }

        $user->activated = ($userRole == 3) ? 0 : 1;
        $user->save();

        return back()->with('success', trans('usersmanagement.updateSuccess'));
    }

    public function destroy(User $user)
    {
        $currentUser = Auth::user();

        if ($user->id !== $currentUser->id) {
            if (method_exists($user, 'setDeletedIp')) {
                $user->setDeletedIp()->save();
            }
            $user->delete();

            return redirect('users')->with('success', trans('usersmanagement.deleteSuccess'));
        }

        return back()->with('error', trans('usersmanagement.deleteSelfError'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('user_search_box');

        $validator = Validator::make($request->all(), [
            'user_search_box' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $results = User::where('id', 'like', $searchTerm.'%')
            ->orWhere('name', 'like', $searchTerm.'%')
            ->orWhere('email', 'like', $searchTerm.'%')
            ->with('roles')
            ->get();

        return response()->json($results, Response::HTTP_OK);
    }

    // ---- Soft-Deleted User Management ----

    public function deletedIndex()
    {
        $users = User::onlyTrashed()->get();

        return view('usersmanagement.show-deleted-users', compact('users'));
    }

    public function deletedShow(int $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        return view('usersmanagement.show-deleted-user', compact('user'));
    }

    public function restore(int $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return redirect('users/deleted')->with('success', trans('usersmanagement.successRestore'));
    }

    public function forceDestroy(int $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect('users/deleted')->with('success', trans('usersmanagement.successDestroy'));
    }

    public function export()
    {
        $users = User::with('roles', 'profile')->get();

        $csv = "ID,Name,Email,First Name,Last Name,Role,Verified,Created,Signup IP\n";
        foreach ($users as $user) {
            $role = $user->roles->first()?->name ?? 'None';
            $verified = $user->email_verified_at ? 'Yes' : 'No';
            $csv .= implode(',', [
                $user->id,
                '"'.str_replace('"', '""', $user->name).'"',
                $user->email,
                '"'.str_replace('"', '""', $user->first_name ?? '').'"',
                '"'.str_replace('"', '""', $user->last_name ?? '').'"',
                $role,
                $verified,
                $user->created_at?->format('Y-m-d'),
                $user->signup_ip_address ?? '',
            ])."\n";
        }

        $filename = 'users-export-'.now()->format('Y-m-d').'.csv';

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}
