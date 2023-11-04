<?php

declare(strict_types=1);

namespace Diouma\LaravelAddService;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Diouma\LaravelAddService\Actions\CreateServiceFileAction;
use Diouma\LaravelAddService\Actions\CreateServiceContractFileAction;
use Diouma\LaravelAddService\Contracts\CreateServiceFileActionContract;
use Diouma\LaravelAddService\Commands\Files\Service\CreateServiceFileCommand;
use Diouma\LaravelAddService\Contracts\CreateServiceContractFileActionContract;
use Diouma\LaravelAddService\Commands\Files\Contract\CreateServiceContractCommand;
use Diouma\LaravelAddService\Commands\Files\Migration\CreateServiceMigrationCommand;
use Diouma\LaravelAddService\Commands\Files\Service\CreateServiceFileWithNoContractCommand;

final class LaravelServiceAddServiceProvider extends PackageServiceProvider
{
    public array $bindings = [
        CreateServiceFileActionContract::class => CreateServiceFileAction::class,
        CreateServiceContractFileActionContract::class => CreateServiceContractFileAction::class,
    ];

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-add-service')
            ->hasConfigFile('add-service')
            ->hasCommand(LaravelAddServiceCommand::class)
            ->hasCommand(CreateServiceFileCommand::class)
            ->hasCommand(CreateServiceFileWithNoContractCommand::class)
            ->hasCommand(CreateServiceContractCommand::class)
            ->hasCommand(CreateServiceMigrationCommand::class);
    }
}