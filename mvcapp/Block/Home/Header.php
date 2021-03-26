<?php

namespace Block\Home;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Header extends \Block\Core\Template
{

    public function __construct()
    {
        $this->setTemplate('./home/header.php');
    }
}
