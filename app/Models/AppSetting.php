<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AppSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
    ];

    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = Cache::rememberForever("app_setting.{$key}", function () use ($key) {
            return static::where('key', $key)->first();
        });

        if (! $setting) {
            return $default;
        }

        return match ($setting->type) {
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $setting->value,
            'json' => json_decode($setting->value, true),
            default => $setting->value,
        };
    }

    public static function set(string $key, mixed $value): static
    {
        $setting = static::where('key', $key)->first();

        if ($setting) {
            $setting->update(['value' => is_array($value) ? json_encode($value) : (string) $value]);
        } else {
            $setting = static::create([
                'key' => $key,
                'value' => is_array($value) ? json_encode($value) : (string) $value,
                'label' => str_replace(['_', '.'], ' ', $key),
            ]);
        }

        Cache::forget("app_setting.{$key}");

        return $setting;
    }

    public static function getByGroup(string $group = 'general')
    {
        return static::where('group', $group)->orderBy('id')->get();
    }
}
