<?php

namespace Model\Attribute;

use Exception;
use \Model\Core\Table;
use Mage;

Mage::loadClassByFileName("Model\Core\Table");

class Option extends Table
{
    protected $attribute = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('attribute_option')->setPrimaryKey('optionId');
    }

    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
        return $this;
    }

    public function getAttribute()
    {
        return $this->attribute;
    }

    public function getOptions()
    {
        try {
            if (!$this->getAttribute()->attributeId) {
                throw new Exception("Attribute Not Found");
            }

            $query = "SELECT *
            FROM `attribute_option`
            WHERE `attributeId`='{$this->getAttribute()->attributeId}'
            ORDER BY `sortOrder` ASC";

            return $this->fetchAll($query);

            //return $this->getAttribute()->getOptions();
        } catch (Exception $e) {
        }
    }
}
