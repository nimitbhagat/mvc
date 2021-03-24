<?php

namespace Model;

use \Model\Core\Table;
use Mage;

Mage::loadClassByFileName("Model\Core\Table");
class Product extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('product')->setPrimaryKey('productId');
    }
}
