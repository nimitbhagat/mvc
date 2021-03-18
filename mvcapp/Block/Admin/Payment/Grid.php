<?php

namespace Block\Admin\Payment;

use Block\Core\Template;
use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{

    protected $payments = null;
    public function __construct()
    {
        $this->setTemplate('./admin/payment/grid.php');
    }
    public function setPayments($payments = null)
    {
        if (!$payments) {
            $payments = Mage::getModel("Model\PaymentModel");
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
}
