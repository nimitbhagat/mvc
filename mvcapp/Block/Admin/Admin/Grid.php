<?php

namespace Block\Admin\Admin;

use Mage;
use Block\Core\Grid as CoreGrid;

Mage::loadClassByFileName('Block\Core\Grid');

class Grid extends CoreGrid
{
    protected $admins = null;
    protected $filter = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/admin/grid.php');
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
    }

    public function setFilter($filter = null)
    {
        if (!$filter) {
            $filter = Mage::getModel('Model\Admin\Filter');
        }
        $this->filter = $filter;
        return $this;
    }

    public function getFilter()
    {
        if (!$this->filter) {
            $this->setFilter();
        }
        return $this->filter;
    }

    public function prepareColumns()
    {
        $this->addColumn(
            'adminId',
            [
                'field' => 'adminId',
                'label' => 'Admin Id',
                'type' => 'number'
            ]
        );
        $this->addColumn(
            'name',
            [
                'field' => 'name',
                'label' => 'Admin Name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'username',
            [
                'field' => 'username',
                'label' => 'Username',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'status',
            [
                'field' => 'status',
                'label' => 'Status',
                'type' => 'boolean'
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

    public function getPaginationAdmin()
    {
        $admins = Mage::getModel("Model\AdminModel");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }


        $query = "Select * from `admin`";
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
        $query .= " LIMIT {$start},{$recordPerPage}";
        return $admins->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `admin`";
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

        $product = Mage::getModel('Model\AdminModel');

        $records = $product->getAdapter()->fetchOne($query);

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
                'label' => 'Add Admin',
                'method' => 'getAddNewUrl',
                'icon' => 'fa fa-plus'
            ]
        );
    }

    public function getEditUrl($row)
    {
        return $this->getUrl()->getUrl('form', null, ['id' => $row->adminId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl()->getUrl('delete', null, ['id' => $row->adminId]);
    }
}
