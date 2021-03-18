<?php

namespace Block\Admin\Admin;

use Mage;
use Block\Core\Template;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends Template
{

    protected $admins = null;
    protected $message = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/admin/grid.php');
    }

    public function setAdmin($admins = null)
    {
        if (!$admins) {
            $admins = Mage::getModel("Model\AdminModel");
            $admins = $admins->fetchAll();
        }
        $this->admins = $admins;
        return $this;
    }
    public function getAdmin()
    {
        if (!$this->admins) {
            $this->setAdmin();
        }
        return $this->admins;
    }
    public function getTitle()
    {
        return "Manage Admins";
    }
}
