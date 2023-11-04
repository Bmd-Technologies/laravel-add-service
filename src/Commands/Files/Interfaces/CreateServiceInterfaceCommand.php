<?php

declare(strict_types=1);

namespace Diouma\LaravelAddService\Commands\Files\Contract;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

final class CreateServiceInterfaceCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:serviceinterfacefile';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Interface';

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__.'/../../../../stubs/service-interface.stub';
    }

    /**
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return "{$rootNamespace}\\Services\\Interfaces";
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
        $interfaceName = "{$name}Interface";

        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $interfaceName)
                    ->replaceClass($stub, $interfaceName);
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

        return $this->laravel['path'].'/'.str_replace('\\', '/', $name.'Interface').'.php';
    }
}