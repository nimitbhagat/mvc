<?php

namespace Controller\Admin;

use Mage;
use Controller\Core\Admin;

class Home extends Admin
{
    public function indexAction()
    {
        $layout = $this->getLayout();
        $home = \Mage::getBlock('Block\Admin\Home\Home');
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($home, 'Grid');
        $this->renderLayout();
    }
}
