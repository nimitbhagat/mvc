<?php

namespace Block\Admin\Product;

use Block\Core\Template;
use Controller\Admin\Admin;
use Mage;

//Mage::loadClassByFileName('block_core_template');

class Edit extends Template
{
  protected $products = null;
  protected $tab = null;

  public function __construct()
  {
    parent::__construct();
    $this->setTemplate('./admin/product/edit.php');
  }

  public function getTabContent()
  {
    $tabsObj = Mage::getBlock("Block\Admin\Product\Edit\Tabs");
    $tabs = $tabsObj->getTabs();
    $fetchTab = $this->getRequest()->getGet('tab');
    if (!array_key_exists($fetchTab, $tabs)) {
      $fetchTab = $tabsObj->getDefault();
    }
    $gotTab = Mage::getBlock($tabs[$fetchTab]['className']);
    echo $gotTab->toHtml();
  }

  public function setTab($tab = null)
  {
    if (!$tab) {
      $tab = Mage::getBlock("Block\Admin\Product\Edit\Tabs");
    }
    $this->tab = $tab;
    return $this;
  }

  public function getTab()
  {
    if (!$this->tab) {
      $this->setTab();
    }

    return $this->tab;
  }

  public function getTabHtml()
  {
    return $this->getTab()->toHtml();
  }
}
