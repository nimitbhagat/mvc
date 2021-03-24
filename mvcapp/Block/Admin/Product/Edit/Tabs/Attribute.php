<?php

namespace Block\Admin\Product\Edit\Tabs;

use Block\Core\Template;
use Mage;

//Mage::loadClassByFileName("block_core_template");
class Attribute extends Template
{
    protected $products = null;
    protected $attributes = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/attribute.php");
    }

    public function setProduct($products = null)
    {
        if (!$products) {
            $products = Mage::getModel("Model\Product");
            if ($id = $this->getRequest()->getGet('id')) {
                $product = $products->load($id);
                if (!$product) {
                    return null;
                }
            }
        }
        $this->products = $products;
        return $this;
    }

    public function getProduct()
    {
        if (!$this->products) {
            $this->setProduct();
        }
        return $this->products;
    }


    public function getAttributes()
    {
        $attribute = Mage::getModel("Model\Attribute");
        $query = "select * from attribute where entityTypeId='product' ORDER BY sortOrder   ";
        $attributes = $attribute->fetchAll($query);

        return $attributes;
    }

    public function getOptions($id)
    {
        $option = Mage::getModel("Model\Attribute\OptionModel");

        $query = "select * from attribute_option where attributeId='{$id}' ORDER BY sortOrder;";
        $options = $option->fetchAll($query);

        return $options;
    }
}
