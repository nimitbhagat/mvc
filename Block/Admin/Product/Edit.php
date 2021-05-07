<?php

namespace Block\Admin\Product;

use Block\Core\Template;
use Mage;

class Edit extends \Block\Core\Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Product\Edit\Tabs'));
    }
}
