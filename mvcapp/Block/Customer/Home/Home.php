<?php

namespace Block\Customer\Home;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Home extends \Block\Core\Template
{

    protected $payments = null;
    public function __construct()
    {
        $this->setTemplate('./home.php');
    }
}
