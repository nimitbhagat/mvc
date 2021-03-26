<?php

namespace Model;

use \Model\Core\Table;
use Mage;

Mage::loadClassByFileName("Model\Core\Table");
class Attribute extends Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('attribute')->setPrimaryKey('attributeId');
    }

    public function getBackendTypeOption()
    {
        return [
            'varchar(255)' => 'Varchar',
            'int' => 'Int',
            'decimal' => 'Decimal',
            'text' => 'Text',
            'boolean' => 'Boolean'
        ];
    }

    public function getInputTypeOption()
    {
        return [
            'text' => 'Textbox',
            'textarea' => 'Textarea',
            'select' => 'Select',
            'multiple' => 'Select Multiple',
            'checkbox' => 'Checkbox',
            'radio' => 'radio'
        ];
    }

    public function getEntityType()
    {
        return [
            'product' => 'Product',
            'category' => 'Category'
        ];
    }

    public function getOptions()
    {
        if (!$this->attributeId) {
            return false;
        }

        return $options = Mage::getModel($this->backendModel)
            ->setAttribute($this)
            ->getOptions();
    }
}
