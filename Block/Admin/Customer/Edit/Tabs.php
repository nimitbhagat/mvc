<?php

namespace Block\Admin\Customer\Edit;

use Block\Core\Edit\Tabs as CoreFormTabs;
use Mage;

class Tabs extends CoreFormTabs
{
    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customer/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('customer', ["label" => "Customer Information", "className" => 'Block\Admin\Customer\Edit\Tabs\Form']);
        $this->addTab('customerAddress', ["label" => "Customer Address", "className" => 'Block\Admin\Customer\Edit\Tabs\CustomerAddress']);
        $this->setDefaultTab('customer');
        return $this;
    }
}
