<?php

use App\Models\Setting;

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null) {
        $setting = Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}

if (!function_exists('setting')) {
    function setting($key, $default = null) {
        return Setting::getValue($key, $default);
    }
}


if (!function_exists('setEnvValue')) {
    function setEnvValue(array $values)
    {
        $envFile = base_path('.env');
        $content = File::get($envFile);

        foreach ($values as $envKey => $envValue) {
            $pattern = "/^{$envKey}=.*/m";

            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, "{$envKey}={$envValue}", $content);
            } else {
                $content .= "\n{$envKey}={$envValue}";
            }
        }

        File::put($envFile, $content);
    }
}
