<?php

namespace Block\Admin\Product\Edit;

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
        $this->addTab('product', [
            "label" => "Product Information",
            "className" => 'Block\Admin\Product\Edit\Tabs\Form'
        ]);

        if ($this->getRequest()->getGet('id')) {
            $this->addTab('media', [
                "label" => "Media",
                "className" => 'Block\Admin\Product\Edit\Tabs\Media'
            ]);

            $this->addTab('attribute', [
                "label" => "Attribute",
                "className" => 'Block\Admin\Product\Edit\Tabs\Attribute'
            ]);

            $this->addTab('groupPrice', [
                "label" => "Price Group",
                "className" => 'Block\Admin\Product\Edit\Tabs\PriceGroup'
            ]);

            $this->addTab('category', [
                "label" => "Category",
                "className" => 'Block\Admin\Product\Edit\Tabs\Category'
            ]);
        }



        $this->setDefault('product');
    }
}
