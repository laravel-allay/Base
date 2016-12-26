<?php
return [
    /**
     * Use Default Generators
     *
     * If true, the default generators list below will be included in addition to any extended
     * generators in the local application.
     *
     * If only *some* of the generators are not desired, the local application must extend the generators
     * configuration and add every generator. There is no means of removing a single generator in the config alone. It's
     * all or nothing!
     */
    'use_default_generators' => true,

    /**
     * Generators
     *
     * An array of classes to use in generating body classes.
     *
     * Simply add a class which implements the following abstract class:
     * \Zschuessler\RouteToClass\Generators\GeneratorAbstract
     *
     * You can put this class anywhere you wish. As an example:
     * app/Providers/RouteToClass/Generators/MyCustomGeneratorName.php
     *
     * You may also interact with the RouteToClass provider directly instead, bypassing
     * the requirement for adding generators here. Note that doing this may lead to technical debt,
     * and that adding generators is the preferred method for long-term maintenance goals.
     *
     * Example of ad-hoc solution:
     *
     * ```
     * $routeToClassProvider = app()['route2class'];
     * $routeToClassProvider->addClass('test-class');
     * $routeToClassProvider->addClass(function() {
     *     // Your own custom logic
     *     return 'test-class-custom-logic';
     * });
     * ```
     */
    'generators' => [
        /**
         * Full Route Path
         *
         * The full route is converted to a class string.
         *
         * eg:
         * `/admin/product/12/edit` becomes `admin-product-edit`
         */
        \Zschuessler\RouteToClass\Generators\FullRoutePath::class,
        \Allay\Base\app\Providers\RouteToClass\AuthPagesGenerator::class,
    ]
];