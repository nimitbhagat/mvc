<?php

namespace Controller\Customer;

use Mage;
use Exception;
use Controller\Core\Admin as CoreAdmin;


Mage::loadClassByFileName('Controller\Core\Admin');

class Home extends CoreAdmin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $gridBlock = Mage::getBlock("Block\Customer\Home\Home");
        $this->renderLayout();
    }
}
