<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Logic\User\UserRepository;
use App\User;
use Input;

// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Query\Expression;
// use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
// use Illuminate\Contracts\Auth\Guard;
// use Illuminate\Support\Facades;
// use App\Models\Role;

class ProfilesController extends Controller {



    //use AuthenticatesAndRegistersUsers;
    protected $auth;
    protected $userRepository;

    // RUN VIEW THROUGH AUTH MIDDLWARE
    public function __construct()
    {
        $this->middleware('auth');
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
    public function update($username)
    {
        $user = $this->getUserByUsername($username)->firstOrFail();

        $input = Input::only('location', 'bio', 'twitter_username', 'github_username');

/*
        $this->profileForm->validate($input);

*/

        $user->profile->fill($input)->save();

        return redirect('profile/'.$user->name.'/edit')->with('status', 'Profile updated!');


    }




}