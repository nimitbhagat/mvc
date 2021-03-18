<?php

namespace Block\Admin\Category\Edit\Tabs;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class Category extends \Block\Core\Template
{

    public function __construct()
    {
        $this->setTemplate("./admin/category/edit/tabs/category.php");
    }
}
