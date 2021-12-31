<?php

namespace App\Http\ViewComposers;

use App\Models\Theme;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ThemeComposer
{
    protected $user;
    protected $theme;

    /**
     * Create a new instance.
     *
     * @return void
     */
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

                if ($theme->status === 0) {
                    $theme = Theme::find(Theme::default);
                }
            }
        }

        $view->with('theme', $theme);
    }
}
