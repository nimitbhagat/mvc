<?php

namespace Block\Admin\CustomerGroup;

use Mage;
use Block\Core\Template;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{

    protected $customerGroups = null;
    public function __construct()
    {
        $this->setTemplate('./admin/customerGroup/grid.php');
    }

    public function setCustomerGroups($customerGroups = null)
    {
        if (!$customerGroups) {
            $customerGroups = Mage::getModel("Model\CustomerGroupModel");
            $customerGroups = $customerGroups->fetchAll();
        }
        $this->customerGroups = $customerGroups;
        return $this;
    }
    public function getCustomerGroups()
    {
        if (!$this->customerGroups) {
            $this->setCustomerGroups();
        }
        return $this->customerGroups;
    }
    public function getTitle()
    {
        return "Manage Customer Group";
    }
}
