<?php

declare(strict_types=1);

namespace Diouma\LaravelAddService\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Diouma\LaravelAddService\Interfaces\CreateServiceFileActionInterface;
use Diouma\LaravelAddService\Interfaces\CreateServiceInterfaceFileActionInterface;

final class LaravelServiceAddCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:service
    {name : Le nom du service que vous souhaitez créer}
    {--N|noContract : Créer un service sans interface}
    ';

    /**
     * @var string
     */
    protected $description = 'Créer un service implémentant sa propre interface';

    /**
     * @var string
     */
    protected $type = 'Service';

    public function handle(
        CreateServiceFileActionInterface $createServiceFileAction,
        CreateServiceInterfaceFileActionInterface $createServiceContractFileAction
    ): int {
        $name = Str::studly($this->argument('name'));

        $createServiceFileAction->handle(
            serviceName: $name,
            noInterface: $this->option('noContract'),
            serviceAddCommand: $this,
        );

        $createServiceContractFileAction->handle(
            serviceName: $name,
            noInterface: $this->option('noContract'),
            serviceAddCommand: $this,
        );

        $this->comment('Fichiers de service créés avec succès!');

        return self::SUCCESS;
    }
}