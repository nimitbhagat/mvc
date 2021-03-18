<?php

namespace Block\Core\Edit;

use Block\Core\Template;
use Mage;

//Mage::loadClassByFileName("Block\Core\Template");

class Tabs extends Template
{
    public function setDefault($key)
    {
        $this->default = $key;
        return $this;
    }

    public function getDefault()
    {
        return $this->default;
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

    public function removeTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            return null;
        }
        unset($this->tabs[$key]);
        return $this;
    }

    public function getTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            return null;
        }
        return $this->tabs[$key];
    }
}
