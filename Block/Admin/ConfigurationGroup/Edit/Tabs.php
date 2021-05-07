<?php

namespace Block\Admin\ConfigurationGroup\Edit;

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
        $this->setTemplate("./admin/configuration_group/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('information', ["label" => "Information", "className" => 'Block\Admin\ConfigurationGroup\Edit\Tabs\Information']);

        if ($this->getRequest()->getGet('id')) {
            $this->addTab('configuration', ["label" => "Configuration", "className" => 'Block\Admin\ConfigurationGroup\Edit\Tabs\Configuration']);
        }
        $this->setDefaultTab('information');
        return $this;
    }
}
