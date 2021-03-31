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
        // $checkout = \Mage::getBlock('Block\Admin\Cart\Checkout');
        // $layout = $this->getLayout();
        // $layout->setTemplate("./core/layout/one_column.php");
        // $checkout->setCart($cart);
        // $layout->getChild("Content")->addChild($checkout, 'Grid');
        // $this->renderLayout();

        $this->getLayout()->setTemplate("./core/layout/home/index.php");

        $checkout = Mage::getBlock("Block\Home\Checkout");
        $this->getLayout()->getChild("Content")->addChild($checkout, 'Checkout');

        $cart = $this->getCart();
        $checkout->setCart($cart);

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
}
