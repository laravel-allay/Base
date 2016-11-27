# Allay Base Package

The Allay base package provides a bare-bones administrator interface.

1. User/admin interface, using AdminLTE
2. Basic menu
3. Error messages & alerts

## Notice!

**This package is not production ready. It does not follow a release cycle.**

Ignore the 1.0 release included in this repository. All development is done on master until
a production release is completed.

*What is this?*

This package is forked from the last MIT-licensed commit of 
[Laravel Backpack](https://github.com/laravel-backpack), citing two reasons:

1. Backpack went the freemium route. Allay will always be MIT.
2. Features will (and already have) diverged from the Backpack repository.

*Should I Contribute?*

Yes. This package is developed full-time, let's build something great and free together.


## Install on Laravel 5.3

1) Run in your terminal:

``` bash
$ composer require allay/base
```

2) Add the service providers in config/app.php:
``` php
Allay\Base\BaseServiceProvider::class,
```

3) Then run a few commands in the terminal:
``` bash

# publish configs, langs, views and AdminLTE files
$ php artisan vendor:publish --provider="Allay\Base\BaseServiceProvider"

# publish config for notifications - prologue/alerts
$ php artisan vendor:publish --provider="Prologue\Alerts\AlertsServiceProvider"

# generates users table (using Laravel's default migrations)
$ php artisan migrate
```

4) Make sure the reset password emails have the correct reset link by adding these to your ```User``` model:
- before class name ```use Allay\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;```
- as a method inside the User class:

``` php
  /**
   * Send the password reset notification.
   *
   * @param  string  $token
   * @return void
   */
  public function sendPasswordResetNotification($token)
  {
      $this->notify(new ResetPasswordNotification($token));
  }
```

5) [optional] Change values in config/allay/base.php to make the admin panel your own. Change menu color, project name, developer name etc.

## Usage 

Use the following default routes:

1. `/admin/register` - Register your user
2. `/admin` or `/login` - Login to your administration panel
3. Consider closing registration or augmenting it once the admin user is created.

## Security

If you discover any security related issues, please email zlschuessler@gmail.com instead of using the issue tracker.

## Credits

- Zachary Schuessler - Vice package maintainer
- Cristian Tabacitu - Laravel Backpack maintainer, which Allay was forked from.

## License

The MIT License (MIT).

See [license.md](license.md) file for more information:

