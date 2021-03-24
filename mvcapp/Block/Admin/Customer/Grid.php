<?php

namespace Block\Admin\Customer;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{

    protected $customers = null;
    public function __construct()
    {

        $this->setTemplate('./admin/customer/grid.php');
    }

    public function setCustomers($customers = null)
    {
        if (!$customers) {
            $customers = Mage::getModel("Model\Customer");
            $customers = $customers->fetchAll();
        }
        $this->customers = $customers;
        return $this;
    }
    public function getCustomers()
    {
        if (!$this->customers) {
            $this->setCustomers();
        }
        return $this->customers;
    }
    public function getTitle()
    {
        return "Manage Customers";
    }

    public function getGroupName($id)
    {
        $customers = Mage::getModel("Model\CustomerGroup");
        $data = $customers->load($id);

        return $data->name;
    }

    public function getZipCode($id)
    {
        $zipcode = Mage::getModel("Model\CustomerAddress");
        $query = "select `zipcode` from `address` where `addressType`='Billing' and `customerId`={$id}";

        $data = $zipcode->getAdapter()->fetchRow($query);

        return ($data) ? $data['zipcode'] : "No Address Found";
    }

    public function getPaginationCustomers()
    {
        $customers = Mage::getModel("Model\Customer");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
        $query = "SELECT * from `customer` LIMIT {$start},{$recordPerPage}";
        return $customers->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `customer`";
        $product = Mage::getModel('Model\Customer');

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
