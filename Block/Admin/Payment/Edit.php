<?php

namespace Block\Admin\Payment;

use Mage;


class Edit extends \Block\Core\Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Payment\Edit\Tabs'));
    }
}
