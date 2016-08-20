<?php

if (! function_exists('settings')) {
    /**
     * Return application settings.
     *
     * @param  mixed $name
     * @param  mixed $default
     * @return mixed
     */
    function settings($name = null, $default = null)
    {
        $settings = app(App\Repositories\SettingsRepository::class);

        if (is_null($name)) {
            return $settings;
        }

        if (is_array($name)) {
            return $settings->set($name);
        }

        return $settings->get($name, $default);
    }
}

if (! function_exists('resample')) {
    /**
     * Return resampled image url.
     *
     * @param  string $path
     * @param  array $params
     * @return string
     */
    function resample($path, array $params = [])
    {
        return route('image', compact('path') + $params);
    }
}
