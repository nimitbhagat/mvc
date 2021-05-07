<?php

namespace Block\Admin\ConfigurationGroup;

use Mage;


class Edit extends \Block\Core\Edit
{
    protected $configurationGroups = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\ConfigurationGroup\Edit\Tabs'));
    }
}
