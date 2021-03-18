<?php

namespace Block\Admin\Shipment;

use Mage;
use Block\Core\Template;

Mage::loadClassByFileName('Block\Core\Template');

class Edit extends Template
{
    protected $shipments = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/shipment/edit.php');
    }

    public function getTabContent()
    {
        $tabsObj = Mage::getBlock("Block\Admin\Shipment\Edit\Tabs");
        $tabs = $tabsObj->getTabs();
        $fetchTab = $this->getRequest()->getGet('tab');
        if (!array_key_exists($fetchTab, $tabs)) {
            $fetchTab = $tabsObj->getDefault();
        }
        $gotTab = Mage::getBlock($tabs[$fetchTab]['className']);
        echo $gotTab->toHtml();
    }
}
