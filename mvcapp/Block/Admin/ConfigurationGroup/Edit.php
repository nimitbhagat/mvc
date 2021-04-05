<?php

namespace Block\Admin\ConfigurationGroup;

use Mage;
use Block\Core\Template;

Mage::loadClassByFileName('Block\Core\Template');

class Edit extends Template
{
    protected $configurationGroups = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/configuration_group/edit.php');
    }

    public function getTabContent()
    {
        $tabsObj = Mage::getBlock("Block\Admin\ConfigurationGroup\Edit\Tabs");
        $tabs = $tabsObj->getTabs();
        $fetchTab = $this->getRequest()->getGet('tab');
        if (!array_key_exists($fetchTab, $tabs)) {
            $fetchTab = $tabsObj->getDefault();
        }
        $gotTab = Mage::getBlock($tabs[$fetchTab]['className']);
        echo $gotTab->toHtml();
    }
}
