<?php

namespace Block\Home;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Footer extends \Block\Core\Template
{

    public function __construct()
    {
        $this->setTemplate('./home/footer.php');
    }
}
