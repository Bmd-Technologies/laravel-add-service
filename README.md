
## What does it do?

This package adds a new `php artisan make:service {name} {--N|noInterface}` command. It will create a service file and its  (interface) for saving time while working with Laravel Framework and benefit from the **Service Pattern**.

## Installation

You can install the package via composer:

```bash
composer require nordcoders/laravel-add-service --dev
```

## How does it work?

After installation, the command `php artisan make:service {name} {--N|noInterface}` will be available.

### Create services files

For example, the command `php artisan make:service createUser` will generate a service file called `CreateUserService.php` located in `app/Services/CreateUser`.

It will also generate an interface called `CreateUserContract.php` located in `app/Services/Interfaces`.

### Create services for models

Adding a ```--service``` or ```-S``` option is now available when creating a model.

For example, the command `php artisan make:model Book --service` or `php artisan make:model Book -S` will generate a model with service too.

The command `php artisan make:model Book --all` or `php artisan make:model Book -a` will now generate a model, migration, factory, seeder, policy, controller, form requests and service.

### Contracts

Adding a ```--noInterface``` or ```-N``` option will prevent the commands from implementing any contract and will not create any contract file.

If you never need any contracts. Publish the config file and then turn the **with_interface** value to false in the config file.

## Configuration file

You can publish the config file with:

```bash
php artisan vendor:publish --tag="service-add-config"
```

This is the content of the published config file:

```php
return [
    'with_interface' => true,
];
```

## Credits

- [Mamadou Diouma II Bah](https://github.com/Bmd-Technologies)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
