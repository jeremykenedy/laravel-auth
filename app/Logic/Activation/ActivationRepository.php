<?php

namespace App\Logic\Activation;

use App\Models\Activation;
use App\Models\User;
use App\Notifications\SendActivationEmail;
use App\Traits\CaptureIpTrait;
use Carbon\Carbon;

class ActivationRepository
{
    /**
     * Creates a token and send email.
     *
     * @param  \App\Models\User  $user
     * @return bool or void
     */
    public function createTokenAndSendEmail(User $user)
    {
        $activations = Activation::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subHours(config('settings.timePeriod')))
            ->count();

        if ($activations >= config('settings.maxAttempts')) {
            return true;
        }

        //if user changed activated email to new one
        if ($user->activated) {
            $user->update([
                'activated' => false,
            ]);
        }

        // Create new Activation record for this user
        $activation = self::createNewActivationToken($user);

        // Send activation email notification
        self::sendNewActivationEmail($user, $activation->token);
    }

    /**
     * Creates a new activation token.
     *
     * @param  \App\Models\User  $user
     * @return \App\Models\Activation $activation
     */
    public function createNewActivationToken(User $user)
    {
        $ipAddress = new CaptureIpTrait();
        $activation = new Activation();
        $activation->user_id = $user->id;
        $activation->token = str_random(64);
        $activation->ip_address = $ipAddress->getClientIp();
        $activation->save();

        return $activation;
    }

    /**
     * Sends a new activation email.
     *
     * @param  \App\Models\User  $user  The user
     * @param  string  $token  The token
     */
    public function sendNewActivationEmail(User $user, $token)
    {
        $user->notify(new SendActivationEmail($token));
    }

    /**
     * Method to removed expired activations.
     *
     * @return void
     */
    public function deleteExpiredActivations()
    {
        Activation::where('created_at', '<=', Carbon::now()->subHours(72))->delete();
    }
}
