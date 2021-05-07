<?php

namespace Block\Admin\Category;

use Mage;


class Edit extends \Block\Core\Edit
{
    protected $categories = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Category\Edit\Tabs'));
    }
}
