<?php

namespace Block\Admin\Product;

use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{

    protected $products = null;
    protected $message = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/product/grid.php');
    }
    public function setProducts($products = null)
    {
        if (!$products) {
            $products = Mage::getModel("Model\Product");
            $products = $products->fetchAll();
        }
        $this->products = $products;
        return $this;
    }
    public function getProducts()
    {
        if (!$this->products) {
            $this->setProducts();
        }
        return $this->products;
    }

    public function getTitle()
    {
        return "Manage Products";
    }

    public function getPaginationProducts()
    {
        $products = Mage::getModel("Model\Product");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
        $query = "SELECT * from `product` LIMIT {$start},{$recordPerPage}";
        return $products->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `product`";
        $product = Mage::getModel('Model\Product');

        $records = $product->getAdapter()->fetchOne($query);

        $this->getPager()->setTotalRecords($records);
        $this->getPager()->setRecordPerPage(10);

        $page = $this->getRequest()->getGet('page');

        if (!$page) {
            $page = 1;
        }
        $this->getPager()->setCurrentPage($page);

        $this->getPager()->calculate();

        return $this;
    }
}
