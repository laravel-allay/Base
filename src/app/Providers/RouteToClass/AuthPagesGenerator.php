<?php

namespace Allay\Base\app\Providers\RouteToClass;

use Zschuessler\RouteToClass\Generators\GeneratorAbstract;

class AuthPagesGenerator extends GeneratorAbstract
{
    public $authCtrlClass = 'Allay\Base\app\Http\Controllers\Auth';

    public function generateClassName()
    {
        $action = $this->getRoute()->getAction();
        $uses   = $action['uses'];

        // Exit early if called from a closure route
        if ($uses instanceof \Closure) {
            return;
        }

        if (isset($action['uses'])
            && true === starts_with($uses, $this->authCtrlClass)) {
            return 'layout-auth-simple';
        }
    }
}