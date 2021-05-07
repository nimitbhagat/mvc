<?php

namespace Block\Admin\Home;

use Mage;
use Block\Core\Template;

class Home extends Template
{
    public function __construct()
    {
        $this->setTemplate('./admin/home/home.php');
    }
}
