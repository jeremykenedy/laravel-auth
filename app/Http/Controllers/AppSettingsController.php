<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AppSettingsController extends Controller
{
    public function index(): View
    {
        $groups = AppSetting::orderBy('group')->orderBy('id')->get()->groupBy('group');

        return view('pages.admin.settings', compact('groups'));
    }

    public function update(Request $request): RedirectResponse
    {
        $settings = $request->input('settings', []);

        foreach ($settings as $key => $value) {
            $setting = AppSetting::where('key', $key)->first();

            if (! $setting) {
                continue;
            }

            if ($setting->type === 'boolean') {
                $value = isset($value) && $value ? '1' : '0';
            }

            $setting->update(['value' => $value ?? '']);
        }

        return back()->with('success', 'Settings saved successfully.');
    }
}
