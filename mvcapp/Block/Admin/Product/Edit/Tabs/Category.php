<?php

namespace Block\Admin\Product\Edit\Tabs;

use Block\Core\Template;
use Mage;

//Mage::loadClassByFileName("block_core_template");
class Category extends Template
{

    public function __construct()
    {
        $this->setTemplate("./admin/product/edit/tabs/category.php");
    }
}
