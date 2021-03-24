<?php

namespace Block\Admin\Customer\Edit\Tabs;

use Mage;
use Block\Core\Template;

Mage::loadClassByFileName("Block\Core\Template");
class CustomerAddress extends \Block\Core\Template
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customer/edit/tabs/customerAddress.php");
    }

    public function validCustomer()
    {
        $id = $this->getRequest()->getGet('id');
        $customers = Mage::getModel("Model\Customer");
        $customer = $customers->load($id);
        if ($customer) {
            return true;
        }
        return false;
    }

    public function setCustomerAddress($customers = null)
    {
        if (!$customers) {
            $customers = Mage::getModel("Model\Customer");
            if ($id = $this->getRequest()->getGet('id')) {
                $customer = $customers->load($id);
                if (!$customer) {
                    return null;
                }
            }
        }
        $this->customers = $customers;
        return $this;
    }

    public function getCustomerAddress()
    {
        if (!$this->customers) {
            $this->setCustomerAddress();
        }
        return $this->customers;
    }

    public function getAddressData($id, $type)
    {
        $customerAddress = Mage::getModel("Model\CustomerAddress");
        $query = "SELECT * from `address` where customerId = {$id} and addressType='{$type}'";
        if (!$customerAddress->fetchAll($query)) {
            return $customerAddress;
        }
        return $customerAddress->fetchAll($query)->getData()[0];
    }
}
