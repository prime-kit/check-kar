<?php

namespace PrimeKit\CheckKar;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use PrimeKit\CheckKar\Commands\CheckKarCommand;

class CheckKarServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('check-kar')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_check_kar_table')
            ->hasCommand(CheckKarCommand::class);
    }
}
