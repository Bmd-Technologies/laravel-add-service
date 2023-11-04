<?php

declare(strict_types=1);

namespace Diouma\LaravelAddService\Commands\Files\Migration;

use Diouma\LaravelAddService\Interfaces\CreateServiceFileActionInterface;
use Diouma\LaravelAddService\Interfaces\CreateServiceInterfaceFileActionInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\ModelMakeCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

final class CreateServiceMigrationCommand extends ModelMakeCommand
{
    private CreateServiceFileActionInterface $createServiceFileActionInterface;

    private CreateServiceInterfaceFileActionInterface $createServiceInterfaceFileActionInterface;

    public function __construct(
        CreateServiceFileActionInterface $createServiceFileActionInterface,
        CreateServiceInterfaceFileActionInterface $createServiceInterfaceFileActionInterface,
    ) {
        parent::__construct(
            new Filesystem(),
        );

        $this->createServiceFileActionInterface = $createServiceFileActionInterface;
        $this->createServiceInterfaceFileActionInterface = $createServiceInterfaceFileActionInterface;
    }

    public function handle(): void
    {
        parent::handle();

        if ($this->option('all')) {
            $this->input->setOption('service', true);
        }

        if ($this->option('service')) {
            $this->createService();
        }
    }

    public function getOptions(): array
    {
        $options = parent::getOptions();

        $options[] = ['service', 'S', InputOption::VALUE_NONE, 'Créer un service pour le modèle'];
        $options[] = ['noInterface', 'N', InputOption::VALUE_NONE, 'Créer un service sans interface'];

        return $options;
    }

    protected function createService(): void
    {
        $this->createServiceFileActionInterface->handle(
            serviceName: $this->getFormattedName(),
            noInterface: $this->option('noInterface'),
            serviceAddCommand: $this,
        );

        $this->createServiceInterfaceFileActionInterface->handle(
            serviceName: $this->getFormattedName(),
            noInterface: $this->option('noInterface'),
            serviceAddCommand: $this,
        );
    }

    protected function getFormattedName(): string
    {
        return Str::studly($this->getNameInput());
    }
}