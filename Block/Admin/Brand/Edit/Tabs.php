<?php

namespace Block\Admin\Brand\Edit;

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
        $this->addTab('brand', ["label" => "Brand Information", "className" => 'Block\Admin\Brand\Edit\Tabs\Form']);
        $this->setDefaultTab('brand');
        return $this;
    }
}
