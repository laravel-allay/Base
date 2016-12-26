<?php

namespace Allay\Base\app\Providers\RouteToClass;

use Zschuessler\RouteToClass\Generators\GeneratorAbstract;

class AuthPagesGenerator extends GeneratorAbstract
{
    public function generateClassName()
    {
        return 'layout-auth-simple';
    }
}