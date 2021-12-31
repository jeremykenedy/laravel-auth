<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RestoreUserController extends ProfilesController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * User Account Restore.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $token
     * @return \Illuminate\Http\Response
     */
    public function userReActivate(Request $request, $token)
    {
        $userKeys = new ProfilesController();
        $sepKey = $userKeys->getSeperationKey();
        $userIdKey = $userKeys->getIdMultiKey();
        $restoreKey = config('settings.restoreKey');
        $encrypter = config('settings.restoreUserEncType');
        $level5 = base64_decode($token);
        $level4 = openssl_decrypt($level5, $encrypter, $restoreKey);
        $level3 = base64_decode($level4);
        $level2 = urldecode($level3);
        $level1[] = explode($sepKey, $level2);
        $uuid = $level1[0][0];
        $userId = $level1[0][1] / $userIdKey;
        $user = SoftDeletesController::getDeletedUser($userId);

        if (! is_object($user)) {
            abort(500);
        }

        $deletedDate = $user->deleted_at;
        $currentDate = Carbon::now();
        $daysDeleted = $currentDate->diffInDays($deletedDate);
        $cutoffDays = config('settings.restoreUserCutoff');

        if ($daysDeleted >= $cutoffDays) {
            return redirect('/login')->with('error', trans('profile.errorRestoreUserTime'));
        }

        $user->restore();

        return redirect('/login')->with('success', trans('profile.successUserRestore', ['username' => $user->name]));
    }
}
