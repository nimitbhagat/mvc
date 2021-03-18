<?php

namespace Block\Admin\Cms;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{

    protected $cmsies = null;
    protected $message = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/cms/grid.php');
    }
    public function setCms($cmsies = null)
    {
        if (!$cmsies) {
            $cmsies = Mage::getModel("Model\CmsModel");
            $cmsies = $cmsies->fetchAll();
        }
        $this->cmsies = $cmsies;
        return $this;
    }
    public function getCms()
    {
        if (!$this->cmsies) {
            $this->setCms();
        }
        return $this->cmsies;
    }
    public function getTitle()
    {
        return "Manage CMS Pages";
    }
}
