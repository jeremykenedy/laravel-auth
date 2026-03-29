<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Notifications\AdminBroadcastNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class AdminNotificationController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        $userCount = User::count();

        return view('admin.notifications.create', compact('roles', 'userCount'));
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'audience' => 'required|in:all,role',
            'role_id' => 'required_if:audience,role|nullable|integer|exists:roles,id',
            'action_url' => 'nullable|url|max:255',
            'action_text' => 'nullable|string|max:50',
            'send_email' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $audience = $request->input('audience');

        if ($audience === 'role') {
            $users = User::whereHas('roles', function ($q) use ($request) {
                $q->where('roles.id', $request->input('role_id'));
            })->get();
        } else {
            $users = User::all();
        }

        if ($users->isEmpty()) {
            return back()->with('error', 'No users found for the selected audience.');
        }

        Notification::send($users, new AdminBroadcastNotification(
            title: $request->input('title'),
            message: $request->input('message'),
            actionUrl: $request->input('action_url'),
            actionText: $request->input('action_text'),
            sendEmail: (bool) $request->input('send_email', false),
        ));

        $roleName = $audience === 'role'
            ? Role::find($request->input('role_id'))?->name
            : 'all';

        return redirect()->route('admin.notifications.create')
            ->with('success', "Notification sent to {$users->count()} user(s) ({$roleName}).");
    }
}
