<?php

class Mage
{

    public static function init()
    {
        self::getController("Controller\Core\Front");

        \Controller\Core\Front::init();
    }
    public static function getModel($className)
    {
        self::loadClassByFileName($className);

        $className = str_replace('\\', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '\\', $className);
        return new $className;
    }
    public static function getBlock($className)
    {
        self::loadClassByFileName($className);

        $className = str_replace('\\', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '\\', $className);
        return new $className();
    }
    public static function getController($className)
    {
        self::loadClassByFileName($className);

        $className = str_replace('\\', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '\\', $className);
        return new $className;
    }
    public static function loadClassByFileName($className)
    {
        $className = str_replace('\\', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '\\', $className);
        $className = $className . '.php';
        require_once($className);
    }

    public  static function prepareClassName($key, $nameSpace)
    {
        $className = $key . '' . $nameSpace;
        $className = str_replace('\\', ' ', $className);
        $className = ucwords($className);
        $className = str_replace(' ', '\\', $className);
        return $className;
    }
}

Mage::init();
