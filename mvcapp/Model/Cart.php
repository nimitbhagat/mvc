<?php

namespace Model;

use Mage;
use Exception;
use \Model\Core\Table;

Mage::getModel('Model\Core\Table');

class Cart extends Table
{
    protected $customer = Null;
    protected $items = Null;
    protected $shippingAddress = null;
    protected $billingAddress = null;
    protected $paymentMethodId = null;
    protected $shippingMethodId = null;
    protected $cart = null;

    public function __construct()
    {
        $this->setTableName('cart');
        $this->setPrimaryKey('cartId');
    }

    public function getCustomer()
    {
        if ($this->customer) {
            return $this->customer;
        }

        if (!$this->customerId) {
            return false;
        }

        $customer =  Mage::getModel('Model\customer')->load($this->customerId);
        $this->setCustomer($customer);
        return $this->customer;
    }


    public function setCustomer(\Model\Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }


    public function setItems(\Model\Cart\Item\Collection $items)
    {
        $this->items = $items;
        return $this;
    }

    public function getItems()
    {

        if (!$this->cartId) {
            return false;
        }

        $query = "SELECT * FROM `cartItem` WHERE `cartId` = '{$this->cartId}'";
        $items =  Mage::getModel('Model\Cart\Item')->fetchAll($query);
        $this->setItems($items);
        return $items;
    }

    public function getBillingAddress()
    {
        if (!$this->cartId) {
            return false;
        }

        $billingAddress = Mage::getModel('Model\Cart\CartAddress');

        $query = "SELECT * FROM `cartaddress` 
        WHERE `cartId` = '{$this->cartId}' AND `addressType`='" . \Model\Cart\CartAddress::ADDRESS_TYPE_BILLING . "'";

        $billingAddress = $billingAddress->fetchRow($query);
        if (!$billingAddress) {
            return null;
        }
        $this->setBillingAddress($billingAddress);
        return $this->billingAddress;
    }

    public function setBillingAddress(\Model\Cart\CartAddress $billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }


    public function getShippingAddress()
    {
        if (!$this->cartId) {
            return false;
        }

        $query = "SELECT * FROM `cartaddress` 
        WHERE `cartId` = '{$this->cartId}' AND `addressType`='Shipping'";

        $shippingAddress = Mage::getModel('Model\Cart\CartAddress')->getAdapter()->fetchRow($query);

        $this->setShippingAddress($shippingAddress);
        return $this->shippingAddress;
    }

    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function getPaymentMethodId()
    {
        return $this->paymentMethodId;
    }

    public function setPaymentMethodId($paymentMethodId)
    {
        $this->paymentMethodId = $paymentMethodId;
        return $this;
    }


    public function getShippingMethodId()
    {
        return $this->shippingMethodId;
    }

    public function setShippingMethodId($shippingMethodId)
    {
        $this->shippingMethodId = $shippingMethodId;

        return $this;
    }

    public function addItem($product, $quantity = 1, $addMode = false)
    {

        $query = "SELECT * FROM `cartItem` WHERE `cartId` = '{$this->cartId}' AND `productId` = '{$product->productId}'";
        $cartItem = Mage::getModel('Model\Cart\Item')->fetchRow($query);
        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->basePrice = ($cartItem->quantity * $cartItem->price);
            $cartItem->save();
            return true;
        }

        $cartItem = Mage::getModel('Model\Cart\Item');
        $cartItem->cartId = $this->cartId;
        $cartItem->productId = $product->productId;
        $cartItem->price = $product->price;
        $cartItem->quantity = $quantity;
        $cartItem->discount = $product->discount;
        $cartItem->createdDate = date('Y-m-d H:i:s');
        $cartItem->basePrice = ($cartItem->quantity * $cartItem->price);

        $cartItem->save();
        return true;
    }
}
