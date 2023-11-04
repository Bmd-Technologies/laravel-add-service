<?php

declare(strict_types=1);

namespace Diouma\LaravelAddService\Commands\Files\Service;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

final class CreateServiceFileCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:servicefile';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Service';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__.'/../../../../stubs/service-with-interface.stub';
    }

    /**
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        $serviceName = str(
            string: $this->argument('name')
        )
            ->ucfirst();

        return "{$rootNamespace}\\Services\\{$serviceName}";
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     *
     * @throws FileNotFoundException
     */
    protected function buildClass($name): string
    {
        $serviceName = "{$name}Service";

        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $serviceName)
                    ->replaceClass($stub, $name);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name): string
    {
        $serviceName = "{$name}Service";
        $class = str_replace($this->getNamespace($serviceName).'\\', '', $serviceName);
        $interfaceName = str_replace($this->getNamespace($serviceName).'\\', '', $name).'Interface';
        $interfaceNamespace = $this->rootNamespace()."Services\\Interfaces\\{$interfaceName}";

        $replace = [
            '{{ class }}' => $class,
            '{{class}}' => $class,
            '{{ interface }}' => $contractName,
            '{{interface}}' => $contractName,
            '{{interfaceNamespace }}' => $interfaceNamespace,
            '{{interfaceNamespace}}' => $interfaceNamespace,
        ];

        return str_replace(array_keys($replace), array_values($replace), $stub);
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name): string
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name.'Service').'.php';
    }
}