<?php

namespace Block\Admin\Shipment;


use Block\Core\Grid as CoreGrid;
use Mage;

class Grid extends CoreGrid
{

    protected $shipments = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/shipment/grid.php');
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

    public function setShipment($shipments = null)
    {
        if (!$shipments) {
            $shipments = Mage::getModel("Model\Shipment");
            $shipments = $shipments->fetchAll();
        }
        $this->shipments = $shipments;
        return $this;
    }

    public function getShipment()
    {
        if (!$this->shipments) {
            $this->setShipment();
        }
        return $this->shipments;
    }

    public function getTitle()
    {
        return "Manage Shipments";
    }

    public function getPaginationShipments()
    {
        $shipments = Mage::getModel("Model\Shipment");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
        $query = "SELECT * from `shipping`";

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

        return $shipments->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `shipping`";
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
        $shipments = Mage::getModel('Model\Shipment');

        $records = $shipments->getAdapter()->fetchOne($query);

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
        return $this->getUrl()->getUrl('form', null, ['id' => $row->shippingId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl()->getUrl('delete', null, ['id' => $row->shippingId]);
    }
}
