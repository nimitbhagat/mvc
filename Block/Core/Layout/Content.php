<?php

namespace Block\Core\Layout;

use Mage;

class Content extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/home/content.php");
    }
}
