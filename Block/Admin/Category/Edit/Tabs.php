<?php

namespace Block\Admin\Category\Edit;

use Block\Core\Edit\Tabs as CoreFormTabs;
use Mage;

class Tabs extends CoreFormTabs
{

    protected $tabs = [];
    protected $default = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/category/edit/tabs.php");
        $this->prepareTab();
    }

    public function prepareTab()
    {
        $this->addTab('category', ["label" => "Category Information", "className" => 'Block\Admin\Category\Edit\Tabs\Form']);
        $this->setDefaultTab('category');
    }
}
