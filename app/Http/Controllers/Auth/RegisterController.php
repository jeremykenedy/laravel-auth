<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Models\User;
use App\Models\Social;
use App\Models\Role;
use App\Models\Profile;
use App\Traits\CaptchaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use CaptchaTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
        $this->middleware('guest',
            ['except' =>
                ['logout', 'activation', 'activateAccount','unactivated']]);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => 'required|max:255|unique:users',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:1|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }



public function unactivated(Request $request) {

    $user = Auth::user();

    if ($user->active) {

        return redirect('home');
    }

    if( $user->resent >= 3 )
    {
        return view('auth.tooManyEmails')->with('email', $user->email);
    }

    return view('auth.guest_activate')->with([
        'email' => $user->email,
        'date'  => $user->created_at->format('m/d/Y'),
    ]);

}



    public function register(Request $request)
    {




        $this->validator($request->all())->validate();


        $activation_code        = str_random(60) . $request->input('email');
        $user                   = new User;
        $user->name             = $request->input('name');
        // $user->first_name       = $request->input('first_name');
        // $user->last_name        = $request->input('last_name');
        $user->email            = $request->input('email');
        $user->password         = bcrypt($request->input('password'));
        $user->activation_code  = $activation_code;

        if ($user->save()) {

            $this->sendEmail($user);
            $user_role = Role::whereName('user')->first();
            $user->assignRole($user_role);

            $profile = new Profile;
            $user->profile()->save($profile);

            return view('auth.activateAccount')->with('email', $request->input('email'));

        } else {

            return redirect()->back()->with('error', 'User not created!');

        }




        // event(new Registered($user = $this->create($request->all())));
        // $this->guard()->login($user);
        // return $this->registered($request, $user) ?: redirect($this->redirectPath());

    }




    public function sendEmail(User $user)
    {
        $data = array(
            'name' => $user->name,
            'code' => $user->activation_code,
        );

        \Mail::queue('emails.activateAccount', $data, function($message) use ($user) {
            $message->subject( \Lang::get('auth.pleaseActivate') );
            $message->to($user->email);
        });
    }








    public function activation(Request $request)
    {
        $user = Auth::user();

        if ($user->active)
        {
            return redirect('home');
        }

        if( $user->resent >= 3 )
        {
            return view('auth.tooManyEmails')->with('email', $user->email);
        }

        $user->resent = $user->resent + 1;
        $user->save();
        $this->sendEmail($user);
        return view('auth.activateAccount')->with('email', $user->email);

    }











    public function activateAccount($code, User $user)
    {

        if($user->accountIsActive($code)) {
            \Session::flash('message', \Lang::get('auth.successActivated') );
            return redirect('home');
        }

        \Session::flash('message', \Lang::get('auth.unsuccessful') );
        return redirect('home');

    }











    public function getSocialRedirect( $provider )
    {
        $providerKey = \Config::get('services.' . $provider);
        if(empty($providerKey))
            return view('pages.status')->with('error','No such provider');

        return Socialite::driver( $provider )->redirect();

    }








    public function getSocialHandle( $provider )
    {

        $user = Socialite::driver( $provider )->user();

        $social_user = null;

        //CHECK IF USERS EMAIL ADDRESS IS ALREADY IN DATABASE
        $user_check = User::where('email', '=', $user->email)->first();
        if(!empty($user_check))
        {
            $social_user = $user_check;
        }
        else // USER IS NOT IN DATABASE BASED ON EMAIL ADDRESS
        {

            $same_social_id = Social::where('social_id', '=', $user->id)->where('provider', '=', $provider )->first();
            // CHECK IF NEW SOCIAL MEDIA USER
            if(empty($same_social_id))
            {

                $new_social_user                    = new User;
                $new_social_user->email             = $user->email;
                $name                               = explode(' ', $user->name);
                if ($user->email) {
                    $new_social_user->name          = $user->email;
                } else {
                    $new_social_user->name          = $name[0];
                }
                $new_social_user->first_name        = $name[0];

                // CHECK FOR LAST NAME
                if (isset($name[1])) {
                    $new_social_user->last_name     = $name[1];
                }

                $new_social_user->active            = '1';
                $the_activation_code                = str_random(60) . $user->email;
                $new_social_user->activation_code   = $the_activation_code;
                $new_social_user->save();
                $social_data                        = new Social;
                $social_data->social_id             = $user->id;
                $social_data->provider              = $provider;
                $new_social_user->social()->save($social_data);

                // ADD ROLE
                $role = Role::whereName('user')->first();
                $new_social_user->assignRole($role);

                $social_user = $new_social_user;

                // LINK TO PROFILE TABLE
                $profile = new Profile;
                $social_user->profile()->save($profile);

            }
            else
            {
                //Load this existing social user
                $social_user = $same_social_id->user;
            }

        }

        $this->auth->login($social_user, true);

        if( $this->auth->user()->hasRole('user'))
        {
            //return redirect()->route('user.home');
            return redirect('app');
        }

        if( $this->auth->user()->hasRole('administrator'))
        {
            return redirect('app');
            //return redirect()->route('admin.home');
        }

        return \App::abort(500);
    }





}
