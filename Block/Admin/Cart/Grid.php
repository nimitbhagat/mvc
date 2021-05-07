<?php

namespace Block\Admin\Cart;

\Mage::getBlock('Block\Core\Grid');

class Grid extends \Block\Core\Grid
{
    protected $cart = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/cart/grid.php');
    }

    public function getCart()
    {
        echo "<pre>";
        if (!$this->cart) {
            throw new \Exception("Cart Is Not Set");
        }
        return $this->cart;
    }

    public function setCart(\Model\Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getId($id)
    {
        $this->getRequest()->getGet('id');
        echo $id;
    }

    public function getCustomers()
    {
        return \Mage::getModel('Model\Customer')->fetchAll();
    }

    /* public function getItems()
    {
        if (!$this->items) {
            return \Mage::getModel('Model\Cart')->getItems();
        }
    } */
}
