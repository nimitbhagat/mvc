<?php

namespace Model;

use Mage;
use Model\Core\Table;

Mage::loadClassByFileName("Model\Core\Table");

class CustomerGroupModel extends \Model\Core\Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('customergroup')->setPrimaryKey('groupId');
    }
}
