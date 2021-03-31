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

    public function getCategory()
    {
        $categoryModel = Mage::getModel('Model\Category');

        $query = "select `categoryId`,`name` from `category`";
        return $this->categoryOptions = $categoryModel->fetchAll($query);
    }


    public function checkCategory($id)
    {
        $productId = $this->getRequest()->getGet('id');
        $productModel = Mage::getModel('Model\Product');
        $query = "select `productId` from `product` where categoryId='{$id}' and productId={$productId}";

        $id = $productModel->getAdapter()->fetchRow($query);

        if ($id) {
            return true;
        }
        return false;
    }
}
