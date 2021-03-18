<?php

namespace Block\Admin\Cms\Edit;

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
        $this->setTemplate("./admin/cms/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('cms', ["label" => "CMS Information", "className" => 'Block\Admin\Cms\Edit\Tabs\Form']);


        $this->setDefault('cms');
    }
}
