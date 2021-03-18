<?php

namespace Block\Admin\Cms;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Edit extends \Block\Core\Template
{
  protected $cmsies = null;

  public function __construct()
  {
    parent::__construct();
    $this->setTemplate('./admin/cms/edit.php');
  }

  public function getTabContent()
  {
    $tabsObj = Mage::getBlock("Block\Admin\Cms\Edit\Tabs");
    $tabs = $tabsObj->getTabs();
    $fetchTab = $this->getRequest()->getGet('tab');
    if (!array_key_exists($fetchTab, $tabs)) {
      $fetchTab = $tabsObj->getDefault();
    }
    $gotTab = Mage::getBlock($tabs[$fetchTab]['className']);
    echo $gotTab->toHtml();
  }
}
