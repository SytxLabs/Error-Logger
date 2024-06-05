<?php

namespace SytxLabs\ErrorLogger;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class ErrorLoggerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/error-logger.php' => config_path('error-logger.php'),
            ], 'config');

            AboutCommand::add('SytxLabs Error Log Package', static fn () => ['Version' => '1.0.0', 'Author' => 'SytxLabs']);
        }
    }

    #[\Override]
    public function register(): void
    {
        parent::register();
        $this->mergeConfigFrom(__DIR__ . '/../config/error-logger.php', 'error-logger');
        $this->mergeConfigFrom(__DIR__ . '/../config/channels.php', 'logging.channels');
    }
}
