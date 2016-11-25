<?php

return [
    // Project name. Shown in the breadcrumbs and a few other places.
    'project_name' => 'Allay',
    
    // Menu logos
    'logo_lg'   => '<b>Allay</b>',
    'logo_mini' => '<b>A</b>',
    
    // Show powered by Laravel Allay in the footer
    'show_powered_by' => true,
    
    /**
     * AdminLTE Skin
     * 
     * Options:
     * 
     * 1. skin-blue
     * 2. skin-blue-light
     * 3. skin-yellow
     * 4. skin-yellow-light
     * 5. skin-green
     * 6. skin-green-light
     * 7. skin-purple
     * 8. skin-purple-light
     * 9. skin-red
     * 10. skin-red-light
     * 11. skin-black
     * 12. skin-black-light
     * 
     * See:
     * https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#adminlte-options
     */
    'skin' => 'skin-black-light',
    
    // Date & Datetime Format Syntax: https://github.com/jenssegers/date#usage
    'default_date_format'     => 'j F Y',
    'default_datetime_format' => 'j F Y H:i',

    /**
     * registration_open
     * 
     * Choose whether users are allowed to register a new account.
     * 
     * This may show a Registration button in the menu and allow access to
     * registration functions in the AuthController.
     */
    'registration_open' => (env('APP_ENV') == 'local') ? true : false,
    
    // Base route prefix for all routes
    'route_prefix' => 'admin',
    
    /**
     * `setup_auth_routes`
     * 
     * Set this false to create your own authentication extensions.
     * You must setup routes and logic manually when set to false.
     * 
     * If true, the default Laravel 5 auth routes are created (register, login,
     * etc)
     * 
     * In addition, a logout route is created.
     */
    'setup_auth_routes' => true,
    
    /**
     * `setup_dashboard_routes`
     * 
     * Bypass default routes and create your own by setting this false.
     * 
     * Routes created:
     * 
     * 1 - `/`
     * 2 - `/dashboard`
     */
    'setup_dashboard_routes' => true,

    /**
     * `dashboard_requires_user_verification`
     *
     * Restricts all access to dashboard until a user is verified, if true.
     */
    'dashboard_requires_user_verification' => true,

    /**
     * `user_verification_middleware_fqn`
     *
     * Fully qualified name of the middleware to use for the user verification feature.
     * Create your own middleware to override default functionality of the Jrean package.
     *
     * Example: \App\Http\Middleware\YourMiddlewareOverrideClass
     */
    'user_verification_middleware_fqn' => '\Jrean\UserVerification\Middleware\IsVerified',
    
    // Fully qualified namespace of the User model
    'user_model_fqn' => '\App\User',
];
