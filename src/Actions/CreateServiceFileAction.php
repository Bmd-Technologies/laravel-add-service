<?php

declare(strict_types=1);

namespace Diouma\LaravelAddService\Actions;

use Diouma\LaravelAddService\Interfaces\CreateServiceFileActionInterface;
use Illuminate\Console\Command;

final class CreateServiceFileAction implements CreateServiceFileActionInterface
{
    public function handle(
        string $serviceName,
        string|bool $noContract,
        Command $serviceMakerCommand,
    ): void {
        if ($noContract) {
            $this->withNoInterface(
                serviceName: $serviceName,
                serviceMakerCommand: $serviceMakerCommand,
            );

            return;
        }

        if (config('service-maker.with_interface')) {
            $this->withInterface(
                serviceName: $serviceName,
                serviceMakerCommand: $serviceMakerCommand,
            );

            return;
        }

        $this->withNoInterface(
            serviceName: $serviceName,
            serviceMakerCommand: $serviceMakerCommand,
        );
    }

    protected function withInterface(string $serviceName, Command $serviceMakerCommand): void
    {
        $serviceMakerCommand->call('make:servicefile', [
            'name' => $serviceName,
        ]);
    }

    protected function withNoInterface(string $serviceName, Command $serviceMakerCommand): void
    {
        $serviceMakerCommand->call('make:servicewithnointerface', [
            'name' => $serviceName,
        ]);
    }
}