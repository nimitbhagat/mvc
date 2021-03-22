<?php

namespace Block\Admin\Brand;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{

    protected $brands = null;
    public function __construct()
    {
        $this->setTemplate('./admin/brand/grid.php');
    }
    public function setBrands($brands = null)
    {
        if (!$brands) {
            $brands = Mage::getModel("Model\BrandModel");
            $brands = $brands->fetchAll();
        }
        $this->brands = $brands;
        return $this;
    }
    public function getBrands()
    {
        if (!$this->brands) {
            $this->setBrands();
        }
        return $this->brands;
    }
    public function getTitle()
    {
        return "Manage Brands";
    }

    public function getPaginationBrands()
    {
        $brands = Mage::getModel("Model\BrandModel");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
        $query = "SELECT * from `brand` LIMIT {$start},{$recordPerPage}";
        return $brands->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `brand`";
        $brands = Mage::getModel('Model\BrandModel');

        $records = $brands->getAdapter()->fetchOne($query);

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
