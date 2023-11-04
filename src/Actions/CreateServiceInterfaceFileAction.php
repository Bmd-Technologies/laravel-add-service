<?php

declare(strict_types=1);

namespace Diouma\LaravelAddService\Actions;

use Diouma\LaravelAddService\Interfaces\CreateServiceInterfaceFileActionInterface;
use Illuminate\Console\Command;

final class CreateServiceInterfaceFileAction implements CreateServiceInterfaceFileActionInterface
{
    public function handle(
        string $serviceName,
        string|bool $noContract,
        Command $serviceMakerCommand,
    ): void {
        if ($noContract) {
            return;
        }

        if (config('service-maker.with_interface')) {
            $this->generateInterface(
                serviceName: $serviceName,
                serviceMakerCommand: $serviceMakerCommand,
            );

            return;
        }
    }

    protected function generateInterface(string $serviceName, Command $serviceMakerCommand)
    {
        $serviceMakerCommand->call('make:serviceinterfacefile', [
            'name' => $serviceName,
        ]);
    }
}