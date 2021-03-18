<?php

namespace Block\Admin\Attribute;

use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{

    protected $attributes = null;
    protected $message = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/attribute/grid.php');
    }
    public function setAttributes($attributes = null)
    {
        if (!$attributes) {
            $attributes = Mage::getModel("Model\AttributeModel");
            $attributes = $attributes->fetchAll();
        }
        $this->attributes = $attributes;
        return $this;
    }
    public function getAttributes()
    {
        if (!$this->attributes) {
            $this->setAttributes();
        }
        return $this->attributes;
    }
    public function getTitle()
    {
        return "Manage Attributes";
    }
}
