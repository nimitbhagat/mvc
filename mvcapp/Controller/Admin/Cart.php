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
                $cart = $this->getCart();
                $cart->total = $this->getCart()->getTotal();

                $cart->save();

                $this->getMessage()->setSuccess('Item added to cart Successfully');
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $this->redirectToPrevious();

        //$this->redirect(null, null, null, true);
        //$this->redirect('grid', 'home\grid', null, true);
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
                    $cart = $this->getCart();
                    $cart->total = $this->getCart()->getTotal();

                    $cart->save();
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

        $this->redirectToPrevious();

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
            $cartId = $this->getCart()->getItems()->getData()[0]->cartId;
            $cart = $this->getCart();
            $cartData = $this->getRequest()->getPost('cart');

            if ($billing) {
                $cartBillingAddress = Mage::getModel('\Model\Cart\CartAddress');
                $query = "SELECT * FROM cartAddress where cartId={$cartId} and addressType='Billing'";
                if (!$cartBillingAddress->fetchRow($query)) {
                    $cartBillingAddress->setData($billing)->save(); 
                } else {
                    $cartBillingAddress->setData($billing)->save();
                }

                if ($this->getRequest()->getPost('billingSaveAddressBook')) {
                    $customer = $this->getCart()->getCustomer();
                    $customerAddress = Mage::getModel('\Model\CustomerAddress');

                    if ($customer->customerId) {
                        $query = "SELECT * FROM `address` where `customerId`={$customer->customerId} and `addressType`='Billing'";
                        if ($customerAddress->fetchRow($query)) {
                            $customerAddress->setData($billing)->save();
                        } else {
                            $customerAddress->customerId = $customer->customerId;
                            $customerAddress->AddressType = "Billing";
                            $customerAddress->setData($billing)->save();
                        }
                    }
                }
            }

            if ($shipping) {
                if ($shipping['sameAsBilling']) {
                    $shipping = $billing;
                    $shipping['sameAsBilling'] = 1;
                }

                $cartBillingAddress = Mage::getModel('\Model\Cart\CartAddress');
                $query = "SELECT * FROM cartAddress where cartId={$cartId} and addressType='Shipping'";

                if (!$cartBillingAddress->fetchRow($query)) {
                    $cartBillingAddress->setData($shipping)->save();
                } else {
                    $cartBillingAddress->setData($shipping)->save();
                }

                if ($this->getRequest()->getPost('shippingSaveAddressBook')) {
                    $customer = $this->getCart()->getCustomer();
                    $customerAddress = Mage::getModel('\Model\CustomerAddress');

                    if ($customer->customerId) {
                        $query = "SELECT * FROM `address` where `customerId`={$customer->customerId} and `addressType`='Shipping'";
                        if ($customerAddress->fetchRow($query)) {
                            $customerAddress->setData($shipping);
                            unset($customerAddress->sameAsBilling);
                            $customerAddress->save();
                        } else {
                            $customerAddress->customerId = $customer->customerId;
                            $customerAddress->AddressType = "Shipping";
                            $customerAddress->setData($shipping)->save();
                        }
                    }
                }
            }

            if ($cartData) {

                $cart->setData($cartData);
                $query = "SELECT * FROM shipping where shippingId ={$cart->shippingMethodId}";

                $shipping = Mage::getModel('\Model\Shipment')->fetchRow($query);

                $cart->shippingAmount = $shipping->amount;

                if (!$cart->save()) {
                    throw new Exception("Shipping & Payment Method Saved Successfully", 1);
                }

                $this->getMessage()->setSuccess("Shipping & Payment Method Updated Successfully");
            }
        } catch (\Exception $th) {
            $this->getMessage()->setFailure('Unable To Set Record');
        }

        $this->redirect('checkout', 'home\home');
    }
}
