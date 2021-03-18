<?php

namespace Controller\Admin\Product;

use Controller\Core\Admin;
use Exception;
use Mage;

Mage::loadClassByFileName('Controller\Core\Admin');

class PriceGroup extends \Controller\Core\Admin
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request", 1);
            }
            $data = $this->getRequest()->getPost('priceGroup');
            $productId = $this->getRequest()->getGet('id');



            if (array_key_exists('exist', $data)) {
                foreach ($data['exist'] as $groupId => $priceGroup) {
                    $priceGroupModel = Mage::getModel("Model\PriceGroupModel");
                    echo $query = "Update `product_customer_group_price` set `groupPrice`= {$priceGroup} where  `customerGroupId`={$groupId} and `productId`={$productId}";

                    if ($priceGroupModel->update($query)) {
                        $this->getMessage()->setSuccess("Product Updated SuccessFully !!");
                    }
                }
            }

            if (array_key_exists('new', $data)) {
                foreach ($data['new'] as $groupId => $priceGroup) {
                    $priceGroupModel = Mage::getModel("Model\PriceGroupModel");
                    $priceGroupModel->productId = $productId;
                    $priceGroupModel->customerGroupId = $groupId;
                    $priceGroupModel->groupPrice = $priceGroup;
                    if ($priceGroupModel->save()) {
                        $this->getMessage()->setSuccess("Product Updated SuccessFully !!");
                    }
                }
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }



        $this->redirect('form', 'product', null, false);
    }
}
