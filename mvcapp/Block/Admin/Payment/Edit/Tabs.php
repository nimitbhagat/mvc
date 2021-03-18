<?php

namespace Block\Admin\Payment\Edit;

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
        $this->setTemplate("./admin/payment/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('payment', ["label" => "Payment Information", "className" => 'Block\Admin\Payment\Edit\Tabs\Form']);
        $this->setDefault('payment');
    }
}
