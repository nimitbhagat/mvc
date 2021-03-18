<?php

namespace Block\Admin\Attribute\Edit;

use Block\Core\Edit\Tabs as CoreTabs;
use Mage;

Mage::loadClassByFileName("Block\Core\Edit\Tabs");
class Tabs extends CoreTabs
{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('attribute', ["label" => "Attribute Information", "className" => 'Block\Admin\Attribute\Edit\Tabs\Form']);
        $this->addTab('option', ["label" => "Option Information", "className" => 'Block\Admin\Attribute\Edit\Tabs\Option']);
        $this->setDefault('attribute');
    }
}
