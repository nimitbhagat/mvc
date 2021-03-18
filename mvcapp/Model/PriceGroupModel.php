<?php

namespace Model;

use Model\Core\Table;
use Mage;

Mage::loadClassByFileName("Model\Core\Table");

class PriceGroupModel extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('Product_customer_group_price')->setPrimaryKey('entityId');
    }
}
