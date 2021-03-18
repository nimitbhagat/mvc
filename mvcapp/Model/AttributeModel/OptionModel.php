<?php

namespace Model\AttributeModel;

use \Model\Core\Table;
use Mage;

Mage::loadClassByFileName("Model\Core\Table");

class OptionModel extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('attribute_option')->setPrimaryKey('optionId');
    }
}
