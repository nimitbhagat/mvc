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
            $shipments = Mage::getModel("Model\ShipmentModel");
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
}
