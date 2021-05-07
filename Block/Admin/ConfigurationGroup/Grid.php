<?php

namespace Block\Admin\ConfigurationGroup;

use Mage;
use Block\Core\Grid as CoreGrid;

Mage::loadClassByFileName('Block\Core\Grid');

class Grid extends CoreGrid
{
    protected $configurationsGroup = null;
    protected $filter = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/configuration_group/grid.php');
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
                'field' => 'groupId',
                'label' => 'Group Id',
                'type' => 'number'
            ]
        );
        $this->addColumn(
            'name',
            [
                'field' => 'name',
                'label' => 'Name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'username',
            [
                'field' => 'createdDate',
                'label' => 'Created Date',
                'type' => 'date'
            ]
        );
    }

    public function setConfigurationGroups($ConfigurationGroups = null)
    {
        if (!$ConfigurationGroups) {
            $ConfigurationGroups = Mage::getModel("Model\ConfigurationGroup");
            $admins = $ConfigurationGroups->fetchAll();
        }
        $this->ConfigurationGroups = $ConfigurationGroups;
        return $this;
    }

    public function getConfigurationGroups()
    {
        if (!$this->ConfigurationGroups) {
            $this->setConfigurationGroups();
        }
        return $this->ConfigurationGroups;
    }

    public function getTitle()
    {
        return "Manage Configurations Groups";
    }

    public function getPaginationAdmin()
    {
        $admins = Mage::getModel("Model\ConfigurationGroup");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }


        $query = "Select * from `config_group`";
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
        $query = "Select * from `config_group`";
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

        $configuration = Mage::getModel('Model\ConfigurationGroup');

        $records = $configuration->getAdapter()->fetchOne($query);

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
                'label' => 'Add Configuration Group',
                'method' => 'getAddNewUrl',
                'icon' => 'fa fa-plus'
            ]
        );
    }

    public function getEditUrl($row)
    {
        return $this->getUrl()->getUrl('form', null, ['id' => $row->groupId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl()->getUrl('delete', null, ['id' => $row->groupId]);
    }
}
