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
            $customers = Mage::getModel("Model\CustomerModel");
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
        $customers = Mage::getModel("Model\CustomerGroupModel");
        $data = $customers->load($id);

        return $data->name;
    }

    public function getZipCode()
    {
        $zipcode = Mage::getModel("Model\CustomerAddressModel");
        $query = "select customerId,zipcode from address where addressType='Billing'";

        $data = $zipcode->fetchAll($query);
        return $data;
    }
}
