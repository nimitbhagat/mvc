<?php

namespace Model\Order;

use \Model\Core\Table;
use Mage;

Mage::loadClassByFileName("Model\Core\Table");
class Address extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('orderaddress')->setPrimaryKey('orderAddressId');
    }
}
