<?php

namespace Controller\Admin;

use Mage;
use Exception;

class Cart extends \Controller\Core\Admin
{
    public function addItemToCartAction()
    {
        try {
            $id = (int)$this->getRequest()->getGet('id');
            $product = \Mage::getModel('Model\Product')->load($id);

            if (!$product) {
                throw new Exception("Product is not Available");
            }

            Mage::getModel('\Model\Admin\Session')->customerId = 8;

            $cart = $this->getCart();

            if ($this->getRequest()->isPost()) {
                $qty = $this->getRequest()->getPost('quantity');
            } else {
                $qty = 1;
            }

            if ($cart->addItem($product, $qty, true)) {
                $this->getMessage()->setSuccess('Item added to cart Successfully');
            } else {
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        header("location:{$_SERVER['HTTP_REFERER']}");
        //echo $_SERVER['HTTP_REFERER'];

        //$this->redirect(null, null, null, true);
        //$this->redirect('grid', 'home\grid', null, true);
    }


    public function indexAction()
    {

        $gridBlock = Mage::getBlock('Block\Admin\Cart\Grid');
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $cart = $this->getCart();
        $gridBlock->setCart($cart);
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
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

    public function updateAction()
    {
        try {
            $quantities = $this->getRequest()->getPost('quantity');

            $cart = $this->getCart();

            foreach ($quantities as $cartItemId => $quantity) {
                $cartItem = \Mage::getModel('Model\Cart\Item')->load($cartItemId);
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
            $this->getMessage()->setSuccess('Item Update to cart Successfully');
        } catch (\Exception $th) {
            echo $th->getMessage();
        }

        $this->redirect('index');
    }



    public function checkoutAction()
    {
        $checkout = \Mage::getBlock('Block\Admin\Cart\Checkout');
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $cart = $this->getCart();
        $checkout->setCart($cart);
        $layout->getChild("Content")->addChild($checkout, 'Grid');
        $this->renderLayout();
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');

            if (!$id) {
                throw new \Exception('Id Invalid');
            }
            $item = \Mage::getModel('Model\Cart\Item');
            $item->load($id)->getData();
            if ($item) {
                if ($item->delete()) {
                    $this->getMessage()->setSuccess('Record Deleted Successfully');
                } else {
                    $this->getMessage()->setFailure('Unable To Delete Record');
                }
            } else {
                $this->getMessage()->setFailure('Id Not found');
            }
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        header("location:{$_SERVER['HTTP_REFERER']}");

        //$this->redirect('grid', 'home\home', null, true);
    }

    public function selectCustomerAction()
    {
        $customerId = $this->getRequest()->getPost('customer');
        $this->getCart($customerId);

        $this->redirect('index', 'Admin_Cart', null, true);
    }

    public function saveAction()
    {
        try {
            $shipping = $this->getRequest()->getPost('shipping');
            $billing = $this->getRequest()->getPost('billing');
            $cartId = $this->getCart()->getItems()[0]->cartId;

            if ($billing) {
                $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$cartId}' AND `addressType` = 'Billing'";
                $cartBillingAddress = \Mage::getModel('Model\Cart\CartAddress')->fetchRow($query);

                if (!$cartBillingAddress) {
                    $cartBillingAddress = \Mage::getModel('Model\Cart\CartAddress');
                }

                $cartBillingAddress->cartId = $cartId;
                $cartBillingAddress->addressType = 'Billing';
                $cartBillingAddress->setData($billing);

                if ($this->getRequest()->getPost('billingSaveAddressBook')) {
                    $customerId = $this->getCart()->customerId;
                    $query = "SELECT * FROM `customer_address` WHERE `customerId`='{$customerId}' AND `addressType`='Billing'";
                    $customer = \Mage::getModel('Model\CustomerAddress')->fetchAll($query);
                    $customer = $customer[0];
                    if (!$customer) {
                        $customer = \Mage::getModel('Model\CustomerAddress');
                    }
                    $cartBillingAddress->addressId = $customer->id;
                    $customer->customerId = $customerId;
                    $customer->addresstype = 'Billing';
                    $customer->setData($billing);
                    $customer->save();
                }

                if (array_key_exists('sameasbilling', $shipping)) {
                    $cartBillingAddress->sameAsBilling = 1;
                    $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$cartId}' AND `addressType` = 'Shipping'";
                    $cartShippingAddress = \Mage::getModel('Model\Cart\CartAddress')->fetchRow($query);
                    if ($cartShippingAddress) {
                        $cartShippingAddress->delete();
                    }
                    if ($cartBillingAddress->save()) {
                        $this->getMessage()->setSuccess('Record Set Successfully');
                    } else {
                        $this->getMessage()->setFailure('Unable To Delete Record');
                    }
                    $this->redirect('checkout');
                } else {
                    $cartBillingAddress->sameAsBilling = 0;
                }

                if ($cartBillingAddress->save()) {

                    $this->getMessage()->setSuccess('Record Set Successfully');
                } else {
                    $this->getMessage()->setFailure('Unable To Delete Record');
                }
            }
            if ($shipping) {
                $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$cartId}' AND `addressType` = 'Shipping'";
                $cartShippingAddress = \Mage::getModel('Model\Cart\CartAddress')->fetchRow($query);

                if (!$cartShippingAddress) {
                    $cartShippingAddress = \Mage::getModel('Model\Cart\CartAddress');
                }

                if ($this->getRequest()->getPost('shippingSaveAddressBook')) {
                    $customerId = $this->getCart()->customerId;
                    $query = "SELECT * FROM `customer_address` WHERE `customerId`='{$customerId}' AND `addressType`='Shipping'";
                    $customer = \Mage::getModel('Model\CustomerAddress')->fetchAll($query);
                    $customer = $customer[0];
                    if (!$customer) {
                        $customer = \Mage::getModel('Model\CustomerAddress');
                    }
                    $cartShippingAddress->addressId = $customer->id;
                    $customer->customerId = $customerId;
                    $customer->addresstype = 'Shipping';
                    $customer->setData($shipping);
                    $customer->save();
                }

                $cartShippingAddress->cartId = $cartId;
                $cartShippingAddress->addressType = 'Shipping';
                $cartShippingAddress->setData($shipping);
                print_r($customer);
                print_r($cartShippingAddress);

                if ($cartShippingAddress->save()) {
                    $this->getMessage()->setSuccess('Record Deleted Successfully');
                } else {
                    $this->getMessage()->setFailure('Unable To Delete Record');
                }
            }
        } catch (\Exception $th) {
            $this->getMessage()->setFailure('Unable To Set Record');
        }

        $this->redirect('checkout');
    }
}
