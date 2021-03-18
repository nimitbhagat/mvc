<?php

namespace Block\Admin\CustomerGroup\Edit;

use Mage;
use Block\Core\Edit\Tabs as CoreFormTabs;

Mage::loadClassByFileName("Block\Core\Edit\Tabs");

class Tabs extends CoreFormTabs
{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/customerGroup/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('customerGroup', ["label" => "Customer Group Information", "className" => 'Block\Admin\customerGroup\Edit\Tabs\Form']);

        $this->setDefault('customerGroup');
    }
}
