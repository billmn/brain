<?php

namespace App\Services;

class Website
{
    /**
     * Available status.
     */
    const STATUS_ONLINE = 'online';
    const STATUS_OFFLINE = 'offline';

    /**
     * Available website Status.
     *
     * @return array
     */
    public function getStatusList()
    {
        return [
            self::STATUS_ONLINE => trans('admin.settings.maintenance.status.'.self::STATUS_ONLINE),
            self::STATUS_OFFLINE => trans('admin.settings.maintenance.status.'.self::STATUS_OFFLINE),
        ];
    }

    /**
     * Check if the website is online.
     *
     * @return bool
     */
    public function isOnline()
    {
        return settings('maintenance.status') !== 'offline';
    }

    /**
     * Check if the website is offline.
     *
     * @return bool
     */
    public function isOffline()
    {
        return settings('maintenance.status') === 'offline';
    }
}
