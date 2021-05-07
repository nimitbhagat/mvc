<?php

namespace Block\Admin\Cart;

\Mage::getBlock('Block\Core\Grid');

class Checkout extends \Block\Core\Grid
{
    protected $cart = null;
    public function __construct()
    {
        $this->setTemplate('./view/admin/cart/checkout.php');
    }

    public function getCart()
    {
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

    public function getId()
    {
        return $this->getRequest()->getGet('id');;
    }

    public function getBillingAddress()
    {

        $cartBillingAddress = $this->getCart()->getBillingAddress();
        if ($cartBillingAddress) {
            return $cartBillingAddress;
        }

        $billingAddress = $this->getCart()->getCustomer()->getBillingAddress();

        if ($billingAddress) {
            $cartAddress = \Mage::getModel('Model\Cart\CartAddress');
            $cartAddress->addressId = $billingAddress->id;
            $cartAddress->addressType = $billingAddress->addressType;
            $cartAddress->address = $billingAddress->address;
            $cartAddress->city = $billingAddress->city;
            $cartAddress->state = $billingAddress->state;
            $cartAddress->country = $billingAddress->country;
            $cartAddress->zipcode = $billingAddress->zipcode;
            $cartAddress->cartId = $this->getCart()->getItems()[0]->cartId; //---
            $cartAddress->save();
            return $cartAddress;
        }

        return Null;
    }

    public function getShippingAddress()
    {
        $cartShippingAddress = $this->getCart()->getShippingAddress();

        if ($cartShippingAddress) {
            return $cartShippingAddress;
        }

        $shippingAddress = $this->getCart()->getCustomer()->getShippingAddress();

        if ($shippingAddress) {
            $cartAddress = \Mage::getModel('Model\Cart\CartAddress');
            $cartAddress->addressId = $shippingAddress->id;
            $cartAddress->addressType = $shippingAddress->addressType;
            $cartAddress->address = $shippingAddress->address;
            $cartAddress->city = $shippingAddress->city;
            $cartAddress->state = $shippingAddress->state;
            $cartAddress->country = $shippingAddress->country;
            $cartAddress->zipcode = $shippingAddress->zipcode;
            $cartAddress->cartId = $this->getCart()->getItems()[0]->cartId; //---
            $cartAddress->save();

            return $cartAddress;
        }

        return Null;
    }
}
