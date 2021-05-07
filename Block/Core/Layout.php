<?php

namespace Block\Core;

use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Layout extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/one_column.php");
        $this->prepareChildren();
    }

    public function prepareChildren()
    {
        $sidebar = Mage::getBlock("Block\Core\Layout\Sidebar");
        $this->addChild($sidebar, "Sidebar");

        $header = Mage::getBlock("Block\Core\Layout\Header");
        $this->addChild($header, "Header");

        $footer = Mage::getBlock("Block\Core\Layout\Footer");
        $this->addChild($footer, "Footer");

        $content = Mage::getBlock("Block\Core\Layout\Content");
        $this->addChild($content, "Content");
    }

    public function getContent()
    {
        return $this->getChild('content');
    }

    public function getLeft()
    {
        return $this->getChild('Sidebar');
    }
}
