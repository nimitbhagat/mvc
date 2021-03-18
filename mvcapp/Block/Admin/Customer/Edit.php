<?php

namespace Block\Admin\Customer;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Edit extends \Block\Core\Template
{


  public function __construct()
  {
    parent::__construct();
    $this->setTemplate('./admin/customer/edit.php');
  }

  public function getTabContent()
  {
    $tabsObj = Mage::getBlock("Block\Admin\Customer\Edit\Tabs");
    $tabs = $tabsObj->getTabs();
    $fetchTab = $this->getRequest()->getGet('tab');
    if (!array_key_exists($fetchTab, $tabs)) {
      $fetchTab = $tabsObj->getDefault();
    }
    $gotTab = Mage::getBlock($tabs[$fetchTab]['className']);
    echo $gotTab->toHtml();
  }
}
