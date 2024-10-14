<?php

namespace PrimeKit\CheckKar;

use PrimeKit\CheckKar\Console\Command\Redis\RedisTestConnectionCommand;
use PrimeKit\CheckKar\Console\Command\S3\TestStorageConnectionCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CheckKarServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('check-kar')
            ->hasViews()
            ->hasCommands([
                RedisTestConnectionCommand::class,
                TestStorageConnectionCommand::class,
            ]);
    }
}
