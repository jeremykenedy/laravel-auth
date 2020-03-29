<?php

namespace App\Traits;

use App\Logic\Activation\ActivationRepository;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

trait ActivationTrait
{
    /**
     * Trigger Activation Email
     * Note: this was build pre laravel verification emails.
     *
     * @param  User $user
     *
     * @return void
     */
    public function initiateEmailActivation(User $user)
    {
        if (! config('settings.activation') || ! $this->validateEmail($user)) {
            return true;
        }

        $activationRepostory = new ActivationRepository();
        $activationRepostory->createTokenAndSendEmail($user);
    }

    /**
     * Validate the Users Email.
     *
     * @param  User $user
     *
     * @return bool
     */
    protected function validateEmail(User $user)
    {
        $validator = Validator::make(['email' => $user->email], ['email' => 'required|email']);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
