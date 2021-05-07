<?php

namespace Block\Admin\Customer;

use Mage;
use Block\Core\Grid as CoreGrid;

class Grid extends CoreGrid
{

    protected $customers = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/customer/grid.php');
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
    }

    public function prepareColumns()
    {
        $this->addColumn(
            'group',
            [
                'field' => 'group',
                'label' => 'Group',
                'type' => 'select',
                'method' => 'getGroupName'
            ]
        );
        $this->addColumn(
            'firstName',
            [
                'field' => 'firstName',
                'label' => 'First Name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'lastName',
            [
                'field' => 'lastName',
                'label' => 'Last Name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'email',
            [
                'field' => 'email',
                'label' => 'Email',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'zipCode',
            [
                'field' => 'zipCode',
                'label' => 'Zipcode',
                'type' => 'text',
                'method' => 'getZipCode'
            ]
        );
        $this->addColumn(
            'mobile',
            [
                'field' => 'mobile',
                'label' => 'Contact No',
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

    public function setCustomers($customers = null)
    {
        if (!$customers) {
            $customers = Mage::getModel("Model\Customer");
            $customers = $customers->fetchAll();
        }
        $this->customers = $customers;
        return $this;
    }

    public function getCustomers()
    {
        if (!$this->customers) {
            $this->setCustomers();
        }
        return $this->customers;
    }

    public function getTitle()
    {
        return "Manage Customers";
    }

    public function getGroupName($id)
    {
        $customers = Mage::getModel("Model\CustomerGroup");
        $data = $customers->load($id);
        return ($data) ? $data->name : null;
    }

    public function getZipCode($id)
    {
        $zipcode = Mage::getModel("Model\CustomerAddress");
        $query = "select `zipcode` from `address` where `addressType`='Billing' and `customerId`={$id}";

        $data = $zipcode->getAdapter()->fetchRow($query);

        return ($data) ? $data['zipcode'] : "No Address Found";
    }

    public function getPaginationCustomers()
    {
        $customers = Mage::getModel("Model\Customer");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }

        $query = "Select * from `customer`";
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

        return $customers->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `customer`";

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

        $product = Mage::getModel('Model\Customer');

        $records = $product->getAdapter()->fetchOne($query);

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
                'label' => 'Add Admin',
                'method' => 'getAddNewUrl',
                'icon' => 'fa fa-plus'
            ]
        );
    }

    public function getEditUrl($row)
    {
        return $this->getUrl()->getUrl('form', null, ['id' => $row->customerId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl()->getUrl('delete', null, ['id' => $row->customerId]);
    }
}
