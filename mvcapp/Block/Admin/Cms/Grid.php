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

    public function getPaginationCms()
    {
        $Cms = Mage::getModel("Model\ProductModel");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
        $query = "SELECT * from `cms_page` LIMIT {$start},{$recordPerPage}";
        return $Cms->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `cms_page`";
        $cms = Mage::getModel('Model\CmsModel');

        $records = $cms->getAdapter()->fetchOne($query);

        $this->getPager()->setTotalRecords($records);
        $this->getPager()->setRecordPerPage(10);

        $page = $this->getRequest()->getGet('page');

        if (!$page) {
            $page = 1;
        }
        $this->getPager()->setCurrentPage($page);

        $this->getPager()->calculate();

        return $this;
    }
}
