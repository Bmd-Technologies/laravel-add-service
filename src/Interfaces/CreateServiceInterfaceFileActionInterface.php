<?php

declare(strict_types=1);

namespace Diouma\LaravelAddService\Interfaces;

use Illuminate\Console\Command;

interface CreateServiceInterfaceFileActionInterface
{
    public function handle(
        string $serviceName,
        string|bool $noInterface,
        Command $serviceAddCommand
    ): void;
}