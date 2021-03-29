<?php

namespace Controller\Home;

use Mage;
use Exception;
use Controller\Core\Admin as CoreAdmin;


Mage::loadClassByFileName('Controller\Core\Admin');

class Grid extends CoreAdmin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $gridBlock = Mage::getBlock("Block\Home\Home");
        $this->getLayout()->setTemplate("./home/index.php");
        $this->getLayout()->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }

    public function gridAction()
    {
        $gridBlock = Mage::getBlock("Block\Home\Home");
        $this->getLayout()->setTemplate("./home/grid.php");
        $this->getLayout()->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }
}
