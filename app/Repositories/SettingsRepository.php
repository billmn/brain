<?php

namespace App\Repositories;

use App\Models\Settings;
use Illuminate\Contracts\Cache\Repository as Cache;

class SettingsRepository
{
    protected $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * All settings.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->setCache(function () {
            return Settings::orderBy('name')->pluck('value', 'name');
        });
    }

    /**
     * Get setting's value.
     *
     * @param  string $name
     * @param  mixed  $default
     * @return mixed
     */
    public function get($name, $default = null)
    {
        $settings = $this->cache->get('settings', function () {
            return $this->all();
        });

        return array_get($settings, $name, $default);
    }

    /**
     * Register setting's value.
     *
     * @param string  $name
     * @param mixed   $value
     * @param bool $forgetCache
     * @return mixed
     */
    public function set($name, $value = null, $forgetCache = true)
    {
        if (is_array($name)) {
            foreach ($name as $field => $value) {
                $this->set($field, $value, false);
            }

            $this->flushCache();

            return $this->all();
        }

        $record = Settings::firstOrNew(compact('name'));
        $record->name = $name;
        $record->value = $value;
        $record->save();

        if ($forgetCache) {
            $this->flushCache();
        }

        return $this->get($name);
    }

    /**
     * Delete setting's value.
     *
     * @param  string $name
     * @return void
     */
    public function delete($name)
    {
        if ($record = Settings::find($name)) {
            $record->delete();
            $this->flushCache();
        }
    }

    /**
     * Remove all settings.
     *
     * @return void
     */
    public function flush()
    {
        $this->flushCache();
        Settings::truncate();
    }

    public function setCache($callback)
    {
        return $this->cache->rememberForever('settings', $callback);
    }

    /**
     * Flush setting's cache.
     *
     * @return void
     */
    public function flushCache()
    {
        $this->cache->forget('settings');
    }
}
