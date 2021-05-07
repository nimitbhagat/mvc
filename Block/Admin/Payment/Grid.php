<?php

namespace Block\Admin\Payment;

use Block\Core\Grid as CoreGrid;
use Mage;


class Grid extends CoreGrid
{

    protected $payments = null;
    public function __construct()
    {
        $this->setTemplate('./admin/payment/grid.php');
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
    }

    public function prepareColumns()
    {
        $this->addColumn(
            'name',
            [
                'field' => 'name',
                'label' => 'Name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'code',
            [
                'field' => 'code',
                'label' => 'Code',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'amount',
            [
                'field' => 'amount',
                'label' => 'Amount',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'description',
            [
                'field' => 'description',
                'label' => 'Description',
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

    public function setPayments($payments = null)
    {
        if (!$payments) {
            $payments = Mage::getModel("Model\Payment");
            $payments = $payments->fetchAll();
        }
        $this->payments = $payments;
        return $this;
    }
    public function getPayments()
    {
        if (!$this->payments) {
            $this->setPayments();
        }
        return $this->payments;
    }
    public function getTitle()
    {
        return "Manage Payments";
    }

    public function getPaginationPayments()
    {
        $payments = Mage::getModel("Model\Payment");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }

        $query = "SELECT * from `payment`";

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

        return $payments->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `payment`";
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
        $payments = Mage::getModel('Model\Payment');

        $records = $payments->getAdapter()->fetchOne($query);

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
        return $this->getUrl()->getUrl('form', null, ['id' => $row->paymentId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl()->getUrl('delete', null, ['id' => $row->paymentId]);
    }
}
