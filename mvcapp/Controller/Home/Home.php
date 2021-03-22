<?php

namespace Controller\Home;

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
        $gridBlock = Mage::getBlock("Block\Home\Home");
        $this->getLayout()->setTemplate("./core/layout/template.php");
        $this->getLayout()->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }
}
