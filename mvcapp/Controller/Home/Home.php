<?php

namespace Controller\Home;

use Mage;
use Exception;
use Controller\Core\Admin as CoreAdmin;


Mage::loadClassByFileName('Controller\Core\Admin');

class Home extends CoreAdmin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexAction()
    {
        $langing = Mage::getBlock("Block\Home\Landing");
        $this->getLayout()->setTemplate("./core/layout/home/index.php");
        $this->getLayout()->getChild("Content")->addChild($langing, 'Grid');
        $this->renderLayout();
    }

    public function gridAction()
    {

        $this->getLayout()->setTemplate("./core/layout/home/index.php");

        $shopBy = Mage::getBlock("Block\Home\ShopBy");
        $this->getLayout()->getChild("Content")->addChild($shopBy, 'Grid');

        $productGrid = Mage::getBlock("Block\Home\Products");
        $this->getLayout()->getChild("Content")->addChild($productGrid, 'ProductGrid');

        $this->renderLayout();
    }

    public function detailAction()
    {
        $this->getLayout()->setTemplate("./core/layout/home/index.php");

        $productDetails = Mage::getBlock("Block\Home\ProductDetails");
        $this->getLayout()->getChild("Content")->addChild($productDetails, 'Grid');
        $this->renderLayout();
    }

    public function checkoutAction()
    {
        try {
            $cart = $this->getCart();

            if (!$cart->getItems()) {
                throw new Exception("No Item In Cart", 1);
            }

            $this->getLayout()->setTemplate("./core/layout/home/index.php");

            $checkout = Mage::getBlock("Block\Home\Checkout");
            $this->getLayout()->getChild("Content")->addChild($checkout, 'Checkout');

            $checkout->setCart($cart);

            $this->renderLayout();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirectToPrevious();
        }
    }

    protected function getCart($customerId = NULL)
    {
        $session = \Mage::getModel('Model\Admin\Session');

        if ($customerId) {
            $session->customerId = $customerId;
        }

        $sessionId = \Mage::getModel('Model\Admin\Session')->getId();
        $cart = \Mage::getModel('Model\Cart');
        $query = "SELECT * FROM `cart` WHERE `customerId` = '{$session->customerId}'";
        $cart = $cart->fetchRow($query);

        if ($cart) {
            return $cart;
        }

        $cart = \Mage::getModel('Model\Cart');
        $cart->customerId = $session->customerId;
        $cart->createdDate = date('Y-m-d H:i:s');
        $cart->sessionId = $sessionId;
        $cart->save();
        return $cart;
    }

    public function placeOrderAction()
    {

        try {
            $customerId = Mage::getModel('\Model\Admin\Session')->customerId;

            $customer = Mage::getModel('\Model\Customer')->load($customerId);

            $cart = $this->getCart();


            $shipping = Mage::getModel('\Model\Shipment')->load($cart->shippingMethodId);
            $payment = Mage::getModel('\Model\Payment')->load($cart->paymentMethodId);

            $query = "SELECT * FROM cartAddress where cartId={$cart->cartId}";
            $cartAddress = Mage::getModel('\Model\Cart\CartAddress')->fetchAll($query);


            $items = $this->getCart()->getItems();

            $order = Mage::getModel('\Model\Order');

            $order->setData($cart->getData());

            unset($order->sessionId);
            unset($order->cartId);
            $order->customerFirstName = $customer->firstName;
            $order->customerLastName = $customer->lastName;
            $order->customerEmail = $customer->email;
            $order->customerContact = $customer->mobile;
            $order->shippingName = $shipping->name;
            $order->shippingCode = $shipping->code;
            $order->paymentName = $payment->name;
            $order->paymentCode = $payment->code;
            $order->createdDate = date("Y-m-d H:i:s");

            if ($order = $order->save()) {
                $orderId = $order->getAdapter()->getConnect()->insert_id;

                foreach ($cartAddress->getData() as $address) {
                    $orderAddress = Mage::getModel('\Model\Order\Address');
                    $orderAddress->setData($address->getData());
                    unset($orderAddress->cartId);
                    unset($orderAddress->cartAddressId);
                    $orderAddress->orderId = $orderId;

                    if (!$orderAddress->save()) {
                        throw new Exception("Order Failed", 1);
                    }
                }
                foreach ($items->getData() as $value) {
                    $orderItem = Mage::getModel('\Model\Order\Items');

                    $orderItem->setData($value->getData());
                    unset($orderItem->cartItemId);
                    unset($orderItem->cartId);

                    $product = Mage::getModel('\Model\Product')->load($orderItem->productId);

                    $orderItem->orderDetailId = $orderId;
                    $orderItem->productName = $product->name;
                    $orderItem->createdDate = date("Y-m-d H:i:s");
                    if (!$orderItem->save()) {
                        throw new Exception("Order Failed", 1);
                    }
                }
                $cart->delete();

                $this->getMessage()->setSuccess("Order Placed !!");
            } else {
                throw new Exception("Order Failed", 1);
            }
        } catch (Exception $e) {
            if (!isset($orderId)) {
                $order->delete("DELETE FROM `orderdetails` WHERE `orderdetails`.`orderId` = {$orderId}");
            }
        }

        $this->redirect('index', 'home\home', null, true);
    }
}
