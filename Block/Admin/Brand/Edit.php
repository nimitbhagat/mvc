<?php

namespace Block\Admin\Brand;

use Mage;

class Edit extends \Block\Core\Edit
{


    public function __construct()
    {
        parent::__construct();

        //$this->setTemplate('./admin/brand/edit.php');

        $this->setTabClass(\Mage::getBlock('Block\Admin\Brand\Edit\Tabs'));
    }
}
