<?php

namespace Block\Admin\Cms;

use Block\Core\Grid as CoreGrid;
use Mage;


class Grid extends CoreGrid
{

    protected $cmsies = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/cms/grid.php');
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
    }

    public function prepareColumns()
    {
        $this->addColumn(
            'pageId',
            [
                'field' => 'pageId',
                'label' => 'Page Id',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'name',
            [
                'field' => 'title',
                'label' => 'Title',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'identifier',
            [
                'field' => 'identifier',
                'label' => 'Identifyer',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'content',
            [
                'field' => 'content',
                'label' => 'Content',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'status',
            [
                'field' => 'status',
                'label' => 'Status',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'createdDate',
            [
                'field' => 'createdDate',
                'label' => 'Created Date',
                'type' => 'text'
            ]
        );
    }

    public function setCms($cmsies = null)
    {
        if (!$cmsies) {
            $cmsies = Mage::getModel("Model\Cms");
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
        $Cms = Mage::getModel("Model\Product");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }

        $query = "Select * from `cms_page`";
        if ($this->getFilter()->hasFilters()) {
            $query .= " Where 1=1 ";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= "AND `{$key}` LIKE '%{$value}%'";
                    }
                }
            }
        }
        echo $query .= " LIMIT {$start},{$recordPerPage}";



        return $Cms->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `cms_page`";

        if ($this->getFilter()->hasFilters()) {
            $query .= " Where 1=1 ";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= "AND `{$key}` LIKE '%{$value}%'";
                    }
                }
            }
        }

        $cms = Mage::getModel('Model\Cms');

        $records = $cms->getAdapter()->fetchOne($query);

        $this->getPager()->setTotalRecords($records);
        $this->getPager()->setRecordPerPage(5);

        $page = $this->getRequest()->getGet('page');

        if (!$page) {
            $page = 1;
        }
        $this->getPager()->setCurrentPage($page);

        $this->getPager()->calculate();

        return $this;
    }

    public function prepareActions()
    {
        $this->addAction(
            'edit',
            [
                'label' => 'Edit',
                'class' => 'fa fa-pencil btn-info btn',
                'method' => 'getEditUrl',
            ]
        );

        $this->addAction(
            'delete',
            [
                'label' => 'Delete',
                'class' => 'fa fa-trash btn-danger btn',
                'method' => 'getDeleteUrl',
            ]
        );
    }

    public function prepareButtons()
    {
        $this->addButton(
            'addnew',
            [
                'label' => 'Add Page',
                'method' => 'getAddNewUrl',
                'icon' => 'fa fa-plus'
            ]
        );
    }

    public function getEditUrl($row)
    {
        return $this->getUrl()->getUrl('form', null, ['id' => $row->pageId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl()->getUrl('delete', null, ['id' => $row->pageId]);
    }
}
