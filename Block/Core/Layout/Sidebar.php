<?php

namespace Block\Core\Layout;

use Mage;

class Sidebar extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/sidebar.php");
    }
}
