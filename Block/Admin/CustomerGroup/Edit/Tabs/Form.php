<?php

namespace Block\Admin\CustomerGroup\Edit\Tabs;

use Mage;

class Form extends \Block\Core\Edit
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
            $customerGroups = Mage::getModel("Model\CustomerGroup");
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
