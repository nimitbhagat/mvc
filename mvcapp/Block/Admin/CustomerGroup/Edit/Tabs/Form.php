<?php

namespace Block\Admin\CustomerGroup\Edit\Tabs;

use Mage;
use Block\Core\Template;

Mage::loadClassByFileName("Block\Core\Template");

class Form extends \Block\Core\Template
{
    protected $customerGroups = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customerGroup/edit/tabs/form.php");
    }

    public function setCustomerGroup($customerGroups = null)
    {
        if (!$customerGroups) {
            $customerGroups = Mage::getModel("Model\CustomerGroupModel");
            if ($id = $this->getRequest()->getGet('id')) {
                $customerGroup = $customerGroups->load($id);
                if (!$customerGroup) {
                    return null;
                }
            }
        }
        $this->customerGroups = $customerGroups;
        return $this;
    }

    public function getCustomerGroup()
    {
        if (!$this->customerGroups) {
            $this->setcustomerGroup();
        }
        return $this->customerGroups;
    }
}
