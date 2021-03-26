<?php

namespace Block\Home;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class ShopBy extends \Block\Core\Template
{

    public function __construct()
    {
        $this->setTemplate('./home/shop_by.php');
    }

    public function getFilters()
    {
        echo "<pre>";
        $query = "SELECT *
        FROM `attribute`
        WHERE `entityTypeId` = 'product';";

        $attributes = Mage::getModel("Model\Attribute")->fetchAll($query);
        foreach ($attributes->getData() as $key => $attribute) {
            $option = Mage::getModel($attribute->backendModel);

            $options = $option->setAttribute($attribute)->getOptions();

            $options;
        }
    }
}
