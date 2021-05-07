<?php

namespace Block\Core\Edit;

use Block\Core\Template;
use Mage;

class Tabs extends Template
{
    protected $tabs = [];
    protected $tableRow = null;
    protected $defaultTab = null;

    public function __construct()
    {
        $this->setTemplate("core/edit/tabs.php");
        $this->prepareTabs();
    }

    public function prepareTabs()
    {
        return $this;
    }

    public function setTableRow(\Model\Core\Table $tableRow)
    {
        $this->tableRow = $tableRow;
        return $this;
    }

    public function getTableRow()
    {
        return $this->tableRow;
    }

    public function setDefault($key)
    {
        $this->default = $key;
        return $this;
    }

    public function getDefault()
    {
        return $this->default;
    }

    public function setDefaultTab($defaultTab)
    {
        $this->defaultTab = $defaultTab;
        return $this;
    }

    public function getDefaultTab()
    {
        return $this->defaultTab;
    }


    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function addTab($key, $tabs = [])
    {

        $this->tabs[$key] = $tabs;
        return $this;
    }


    public function getTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            return null;
        }
        return $this->tabs[$key];
    }

    public function removeTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            return null;
        }
        unset($this->tabs[$key]);
        return $this;
    }
}
