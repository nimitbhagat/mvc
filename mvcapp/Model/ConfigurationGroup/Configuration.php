<?php

namespace Model\ConfigurationGroup;

use Mage;
use Model\Core\Table;

Mage::loadClassByFileName("Model\Core\Table");
class Configuration extends \Model\Core\Table
{

    public function __construct()
    {
        parent::__construct();
        $this->setTableName('config')->setPrimaryKey('configId');
    }
}
