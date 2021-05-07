<?php

namespace Block\Admin\Attribute;

use Block\Core\Template;
use Mage;

//Mage::loadClassByFileName('block_core_template');

class Edit extends \Block\Core\Edit
{
  //protected $attributes = null;

  public function __construct()
  {
    parent::__construct();
    //$this->setTemplate('./admin/attribute/edit.php');
    $this->setTabClass(\Mage::getBlock('Block\Admin\Attribute\Edit\Tabs'));
  }

  // public function getTabContent()
  // {
  //   $tabsObj = Mage::getBlock("Block\Admin\Attribute\Edit\Tabs");
  //   $tabs = $tabsObj->getTabs();
  //   $fetchTab = $this->getRequest()->getGet('tab');
  //   if (!array_key_exists($fetchTab, $tabs)) {
  //     $fetchTab = $tabsObj->getDefault();
  //   }
  //   $gotTab = Mage::getBlock($tabs[$fetchTab]['className']);
  //   echo $gotTab->toHtml();
  // }
}
