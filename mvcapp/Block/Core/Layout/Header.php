<?php

namespace Block\Core\Layout;

use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class Header extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/header.php");
    }
}
