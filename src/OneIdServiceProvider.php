<?php

namespace Ijodkor\OneId;

use Ijodkor\OneId\Console\Commands\OneIdApiMake;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OneIdServiceProvider extends PackageServiceProvider {

    private const APP_NAME = "one-id";

    public function register(): void {
        parent::register();

        // Registers
    }

    public function configurePackage(Package $package): void {
        $package->name(self::APP_NAME)
            ->hasRoutes('web', 'api')
            ->hasConfigFile('integration')
            ->hasCommands(OneIdApiMake::class);
    }
}
