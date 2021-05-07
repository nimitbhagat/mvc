<?php

namespace Block\Admin\Payment\Edit;

use Mage;
use Block\Core\Edit\Tabs as CoreFormTabs;


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
        $this->setDefaultTab('payment');
        return $this;
    }
}
