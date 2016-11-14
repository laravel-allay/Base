# Vice\Base

Laravel Vices's central package, which includes:
- admin login interface, using AdminLTE;
- basic menu;
- pretty error pages;
- alerts system (notification bubbles);

## Install on Laravel 5.3

1) Run in your terminal:

``` bash
$ composer require vice/base
```

2) Add the service providers in config/app.php:
``` php
Vice\Base\BaseServiceProvider::class,
```

3) Then run a few commands in the terminal:
``` bash

#publish configs, langs, views and AdminLTE files
$ php artisan vendor:publish --provider="Vice\Base\BaseServiceProvider"

# publish config for notifications - prologue/alerts
$ php artisan vendor:publish --provider="Prologue\Alerts\AlertsServiceProvider"

#generates users table (using Laravel's default migrations)
$ php artisan migrate
```

4) Make sure the reset password emails have the correct reset link by adding these to your ```User``` model:
- before class name ```use Vice\Base\app\Notifications\ResetPasswordNotification as ResetPasswordNotification;```
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

5) [optional] Change values in config/vice/base.php to make the admin panel your own. Change menu color, project name, developer name etc.

## Usage 

1. Register a new user at yourappname/admin/register
2. Your admin panel will be available at yourappname/admin or yourappname/login
3. [optional] If you're building an admin panel, you should close the registration. In config/vice/base.php look for "registration_open" and change it to false.


## Security

If you discover any security related issues, please email zlschuessler@gmail.com instead of using the issue tracker.

## Credits

- Zachary Schuessler - Vice package maintainer
- Cristian Tabacitu - Laravel Backpack maintainer, which Vice was forked from.

## License

The MIT License (MIT).