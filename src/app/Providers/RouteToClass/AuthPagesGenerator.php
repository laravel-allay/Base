<?php

namespace Allay\Base\app\Providers\RouteToClass;

use Zschuessler\RouteToClass\Generators\GeneratorAbstract;

class AuthPagesGenerator extends GeneratorAbstract
{
    public $authCtrlClass = 'Allay\Base\app\Http\Controllers\Auth';

    public function generateClassName()
    {
        $action = $this->getRoute()->getAction();

        if (isset($action['uses'])
            && true === starts_with($action['uses'], $this->authCtrlClass)) {
            return 'layout-auth-simple';
        }
    }
}