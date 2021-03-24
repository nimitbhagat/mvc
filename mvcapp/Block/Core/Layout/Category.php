<?php

namespace Block\Core\Layout;

use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class Category extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/category.php");
    }

    public function getCategories()
    {
        $category = Mage::getModel('Model\Category');
        $query = "select * from category";
        return $category->fetchAll($query);
    }
}
