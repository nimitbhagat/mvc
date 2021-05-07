<?php

namespace Block\Core\Layout;

use Mage;

class Header extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/header.php");
    }
}
