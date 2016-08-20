<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        settings([
            'theme'    => 'default',
            'timezone' => 'Europe/Rome',

            'website' => [
                'title'  => 'My website',
                'slogan' => 'You will love it!',
                'footer' => 'My website - &copy; Copyright '.date('Y'),
            ],

            'home' => [
                'title' => 'Home',
            ],

            'notfound' => [
                'title'   => 'Page not found',
                'content' => '<h1>Oooops!</h1>This page cannot be found!',
            ],

            'maintenance' => [
                'status'  => 'online',
                'title'   => 'Down for maintenance',
                'content' => "<h1>We'll be back soon!</h1>",
            ],
        ]);
    }
}
