<?php

namespace Block\Admin\Brand;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Edit extends \Block\Core\Template
{
    protected $brands = null;

    public function __construct()
    {
        $this->setTemplate('./admin/brand/edit.php');
    }

    public function getTabContent()
    {
        $tabsObj = Mage::getBlock("Block\Admin\Brand\Edit\Tabs");
        $tabs = $tabsObj->getTabs();
        $fetchTab = $this->getRequest()->getGet('tab');
        if (!array_key_exists($fetchTab, $tabs)) {
            $fetchTab = $tabsObj->getDefault();
        }
        $gotTab = Mage::getBlock($tabs[$fetchTab]['className']);
        echo $gotTab->toHtml();
    }
}
