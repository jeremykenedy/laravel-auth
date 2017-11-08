<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed'   => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    // Activation items
    'sentEmail'        => 'We have sent an email to :email.',
    'clickInEmail'     => 'Please click the link in it to activate your account.',
    'anEmailWasSent'   => 'An email was sent to :email on :date.',
    'clickHereResend'  => 'Click here to resend the email.',
    'successActivated' => 'Success, your account has been activated.',
    'unsuccessful'     => 'Your account could not be activated; please try again.',
    'notCreated'       => 'Your account could not be created; please try again.',
    'tooManyEmails'    => 'Too many activation emails have been sent to :email. <br />Please try again in <span class="label label-danger">:hours hours</span>.',
    'regThanks'        => 'Thank you for registering, ',
    'invalidToken'     => 'Invalid activation token. ',
    'activationSent'   => 'Activation email sent. ',
    'alreadyActivated' => 'Already activated. ',

    // Labels
    'whoops'          => 'Whoops! ',
    'someProblems'    => 'There were some problems with your input.',
    'email'           => 'E-Mail Address',
    'password'        => 'Password',
    'rememberMe'      => ' Remember Me',
    'login'           => 'Login',
    'forgot'          => 'Forgot Your Password?',
    'forgot_message'  => 'Password Troubles?',
    'name'            => 'Username',
    'first_name'      => 'First Name',
    'last_name'       => 'Last Name',
    'confirmPassword' => 'Confirm Password',
    'register'        => 'Register',

    // Placeholders
    'ph_name'          => 'Username',
    'ph_email'         => 'E-mail Address',
    'ph_firstname'     => 'First Name',
    'ph_lastname'      => 'Last Name',
    'ph_password'      => 'Password',
    'ph_password_conf' => 'Confirm Password',

    // User flash messages
    'sendResetLink' => 'Send Password Reset Link',
    'resetPassword' => 'Reset Password',
    'loggedIn'      => 'You are logged in!',

    // email links
    'pleaseActivate'    => 'Please activate your account.',
    'clickHereReset'    => 'Click here to reset your password: ',
    'clickHereActivate' => 'Click here to activate your account: ',

    // Validators
    'userNameTaken'    => 'Username is taken',
    'userNameRequired' => 'Username is required',
    'fNameRequired'    => 'First Name is required',
    'lNameRequired'    => 'Last Name is required',
    'emailRequired'    => 'Email is required',
    'emailInvalid'     => 'Email is invalid',
    'passwordRequired' => 'Password is required',
    'PasswordMin'      => 'Password needs to have at least 6 characters',
    'PasswordMax'      => 'Password maximum length is 20 characters',
    'captchaRequire'   => 'Captcha is required',
    'CaptchaWrong'     => 'Wrong captcha, please try again.',
    'roleRequired'     => 'User role is required.',

];
