<?php

namespace Block\Admin\Shipment;


use Block\Core\Template;
use Mage;
//Mage::loadClassByFileName('Block\Core\Template');

class Grid extends Template
{

    protected $shipments = null;
    protected $message = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/shipment/grid.php');
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
        $query = "SELECT * from `shipping` LIMIT {$start},{$recordPerPage}";
        return $shipments->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `shipping`";
        $shipments = Mage::getModel('Model\Shipment');

        $records = $shipments->getAdapter()->fetchOne($query);

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
