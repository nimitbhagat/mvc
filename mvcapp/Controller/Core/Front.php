<?php

namespace Controller\Core;

use Mage;

class Front
{
    public static function init()
    {
        $request = Mage::getModel('Model\Core\Request');
        $controllerName = ucwords($request->getControllerName());
        $actionName = $request->getActionName() . "Action";
        $controllerClassName = Mage::prepareClassName('Controller\Admin\\', $controllerName);
        $controller = Mage::getController($controllerClassName);
        $controller->$actionName();
    }
}
