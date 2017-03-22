<?php

namespace App\Http\ViewComposers;

use App\Models\Theme;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ThemeComposer
{

    protected $user;
    protected $theme;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {

        $theme = null;

        if (Auth::check()) {

            $user = $this->user;

            if ($user->profile) {
                $theme = Theme::find($user->profile->theme_id);
            }
        }

        $view->with('theme', $theme);
    }

}