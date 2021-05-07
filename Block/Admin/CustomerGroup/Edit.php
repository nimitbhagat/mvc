<?php

namespace Block\Admin\CustomerGroup;

use Mage;

class Edit extends \Block\Core\Edit
{
    protected $groups = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\CustomerGroup\Edit\Tabs'));
    }
}
