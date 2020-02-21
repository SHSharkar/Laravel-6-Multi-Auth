<?php

namespace SHSharkar\Laravel6MultiAuth;

use Illuminate\Support\ServiceProvider;

class Laravel6MultiAuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerInstallCommand();
        $this->registerAuthSettingsInstallCommand();
        $this->registerAuthFilesInstallCommand();
        $this->registerAuthModelInstallCommand();
        $this->registerAuthViewsInstallCommand();
        //$this->registerInstallMiddlewareCommand();
    }

    /**
     * Register the l6ma:install command.
     */
    private function registerInstallCommand()
    {
        $this->app->singleton('command.shsharkar.l6ma.install', function ($app) {
            return $app['SHSharkar\Laravel6MultiAuth\Commands\MultiAuthInstallCommand'];
        });

        $this->commands('command.shsharkar.l6ma.install');
    }

    /**
     * Register the l6ma:install command.
     */
    private function registerAuthSettingsInstallCommand()
    {
        $this->app->singleton('command.shsharkar.l6ma.settings', function ($app) {
            return $app['SHSharkar\Laravel6MultiAuth\Commands\AuthSettingsInstallCommand'];
        });

        $this->commands('command.shsharkar.l6ma.settings');
    }

    /**
     * Register the l6ma:install command.
     */
    private function registerAuthFilesInstallCommand()
    {
        $this->app->singleton('command.shsharkar.l6ma.files', function ($app) {
            return $app['SHSharkar\Laravel6MultiAuth\Commands\AuthFilesInstallCommand'];
        });

        $this->commands('command.shsharkar.l6ma.files');
    }

    /**
     * Register the l6ma:install command.
     */
    private function registerAuthModelInstallCommand()
    {
        $this->app->singleton('command.shsharkar.l6ma.model', function ($app) {
            return $app['SHSharkar\Laravel6MultiAuth\Commands\AuthModelInstallCommand'];
        });

        $this->commands('command.shsharkar.l6ma.model');
    }

    /**
     * Register the l6ma:install command.
     */
    private function registerAuthViewsInstallCommand()
    {
        $this->app->singleton('command.shsharkar.l6ma.views', function ($app) {
            return $app['SHSharkar\Laravel6MultiAuth\Commands\AuthViewsInstallCommand'];
        });

        $this->commands('command.shsharkar.l6ma.views');
    }
}