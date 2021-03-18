<?php

namespace Block\Core\Layout;

use Mage;

Mage::loadClassByFileName("Block\Core\Template");

class Footer extends \Block\Core\Template
{
    public function __construct()
    {
        $this->setTemplate("./core/layout/footer.php");
    }
}
