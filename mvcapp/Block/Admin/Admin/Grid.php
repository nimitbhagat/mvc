<?php

namespace Block\Admin\Admin;

use Mage;
use Block\Core\Template;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends Template
{

    protected $admins = null;
    protected $message = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/admin/grid.php');
    }

    public function setAdmin($admins = null)
    {
        if (!$admins) {
            $admins = Mage::getModel("Model\AdminModel");
            $admins = $admins->fetchAll();
        }
        $this->admins = $admins;
        return $this;
    }
    public function getAdmin()
    {
        if (!$this->admins) {
            $this->setAdmin();
        }
        return $this->admins;
    }
    public function getTitle()
    {
        return "Manage Admins";
    }

    public function getPaginationAdmin()
    {
        $admins = Mage::getModel("Model\AdminModel");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
        $query = "SELECT * from `admin` LIMIT {$start},{$recordPerPage}";
        return $admins->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `admin`";
        $product = Mage::getModel('Model\AdminModel');

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
