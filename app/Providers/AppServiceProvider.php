<?php

namespace App\Providers;

use Form;
use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require app_path('helpers.php');

        $this->registerFormComponents();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBladeExtensions();
    }

    /**
     * Register Blade Extensions.
     *
     * @return void
     */
    protected function registerBladeExtensions()
    {
        Blade::extend(function ($value, $compiler) {
            return preg_replace("/@set\('(.*?)'\,(.*)\)/", '<?php $$1 = $2; ?>', $value);
        });
    }

    /**
     * Register Form Components.
     *
     * @return void
     */
    protected function registerFormComponents()
    {
        Form::component('wysi', 'components.form.wysi', ['name', 'value' => null, 'options' => []]);
        Form::component('media', 'components.form.media', ['name', 'value' => null, 'options' => []]);
        Form::component('source', 'components.form.source', ['name', 'value' => null, 'options' => []]);
        Form::component('errors', 'components.form.errors', ['options' => []]);
        Form::component('delete', 'components.form.delete', ['url', 'confirm' => 'generic']);
        Form::component('datepicker', 'components.form.datepicker', ['name', 'value' => null, 'options' => []]);
        Form::component('timepicker', 'components.form.timepicker', ['name', 'value' => null, 'options' => []]);
    }
}
