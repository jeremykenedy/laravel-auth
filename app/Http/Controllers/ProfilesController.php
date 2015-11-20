<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Logic\User\UserRepository;
use App\Models\Profile;
use App\User;
use Validator;
use Input;

class ProfilesController extends Controller {

    //use AuthenticatesAndRegistersUsers;
    protected $auth;
    protected $userRepository;

    // RUN VIEW THROUGH AUTH MIDDLWARE via the CONSTRUCTOR
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function profile_validator(array $data)
    {
        return Validator::make($data, [
            'location'          => 'required',
            'bio'               => '',
            'twitter_username'  => '',
            'github_username'   => ''
        ]);
    }

    /**
     * /username
     *
     * @param $username
     * @return Response
     */
    public function show($username)
    {
        try {
            $user = $this->getUserByUsername($username);
            //dd($user->toArray());
        } catch (ModelNotFoundException $e) {
            return view('pages.status')
                ->with('error',\Lang::get('profile.notYourProfile'))
                ->with('error_title',\Lang::get('profile.notYourProfileTitle'));
        }
        return view('profiles.show')->withUser($user);
    }

    /**
     * Fetch user
     * (You can extract this to repository method)
     *
     * @param $username
     * @return mixed
     */
    public function getUserByUsername($username)
    {
        return User::with('profile')->wherename($username)->firstOrFail();
    }

    /**
     * /profiles/username/edit
     *
     * @param $username
     * @return mixed
     */
    public function edit($username)
    {
        $user = $this->getUserByUsername($username)->firstOrFail();
        return view('profiles.edit')->withUser($user);
    }

    /**
     * Update a user's profile
     *
     * @param $username
     * @return mixed
     * @throws Laracasts\Validation\FormValidationException
     */
    public function update($username, Request $request)
    {
        $user = $this->getUserByUsername($username)->firstOrFail();

        $input = Input::only('location', 'bio', 'twitter_username', 'github_username');

        $profile_validator = $this->profile_validator($request->all());

        if ($profile_validator->fails()) {

            $this->throwValidationException(
                $request, $profile_validator
            );

            return redirect('profile/'.$user->name.'/edit')->withErrors($validator)->withInput();
        }

        if ($user->profile == null) {
            $profile = new Profile;
            $user->profile()->save($profile);
        } else {
            $user->profile->fill($input)->save();
        }

        return redirect('profile/'.$user->name.'/edit')->with('status', 'Profile updated!');

    }

}