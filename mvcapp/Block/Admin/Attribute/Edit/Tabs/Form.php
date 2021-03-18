<?php

namespace Block\Admin\Attribute\Edit\Tabs;

use Block\Core\Template;
use Mage;

//Mage::loadClassByFileName("block_core_template");
class Form extends Template
{
    protected $attributes = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/attribute/edit/tabs/form.php");
    }

    public function setAttribute($attributes = null)
    {
        if (!$attributes) {
            $attributes = Mage::getModel("Model\AttributeModel");
            if ($id = $this->getRequest()->getGet('id')) {
                $attribute = $attributes->load($id);
                if (!$attribute) {
                    return null;
                }
            }
        }
        $this->attributes = $attributes;
        return $this;
    }

    public function getAttribute()
    {
        if (!$this->attributes) {
            $this->setAttribute();
        }
        return $this->attributes;
    }
}
