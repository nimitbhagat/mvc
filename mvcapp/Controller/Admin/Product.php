<?php

namespace Controller\Admin;

use Controller\Core\Admin as coreAdmin;
use Exception;
use Mage;
use Model\Product as ModelProduct;

//Mage::loadClassByFileName('Controller\Core\Admin');

class Product extends coreAdmin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        $gridBlock = Mage::getBlock("Block\Admin\Product\Grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }
    public function formAction()
    {

        $layout = $this->getLayout();

        $productTab = Mage::getBlock("Block\Admin\Product\Edit\Tabs");
        $layout->getChild('Sidebar')->addChild($productTab, 'Tab');

        $form = Mage::getBlock('Block\Admin\Product\Edit');
        $layout->getChild('Content')->addChild($form, 'Grid');

        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $product = Mage::getModel("Model\Product");
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request", 1);
            }
            $productId = $this->getRequest()->getGet('id');

            if (!$productId) {
                $product->createdDate = date("Y-m-d H:i:s");

                $this->getMessage()->setSuccess("Product Inserted SuccessFully !!");
            } else {
                $product =  $product->load($productId);

                if (!$product) {
                    throw new Exception("Data Not Found", 1);
                }

                $product->updatedDate = date("y-m-d h:i:s");
                $product->productId = $productId;

                $this->getMessage()->setSuccess("Product Updated SuccessFully !!");
            }

            $productData = $this->getRequest()->getPost('product');

            foreach ($productData as $key => $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                    $productData[$key] = $value;
                }
            }


            if (!array_key_exists('status', $productData)) {
                $productData['status'] = 0;
            } else {
                $productData['status'] = 1;
            }

            $product->setData($productData);

            $product->save();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, [], true);
    }

    public function saveCategoryAction()
    {
        try {
            $product = Mage::getModel("Model\Product");
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request", 1);
            }
            $productId = $this->getRequest()->getGet('id');
            $categoryId = $this->getRequest()->getPost('product')['categoryId'];

            $query = "update product set categoryId={$categoryId} where productId={$productId}";
            $product->getAdapter()->update($query);
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', null, [], false);
    }

    public function changeStatusAction()
    {
        try {

            $id = $this->getRequest()->getGet('id');
            $st = $this->getRequest()->getGet('status');
            $model = Mage::getModel('Model\Product');
            $model->id = $id;
            $model->status = $st;
            if ($model->changeStatus()) {
                $this->getMessage()->setSuccess("Status Changed Successfully");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
    public function deleteAction()
    {
        try {
            if ($this->request->isPost()) {
                throw new Exception("Invalid Request", 1);
            }

            $id = $this->getRequest()->getGet('id');
            $delModel = Mage::getModel('Model\Product');
            $delModel->productId = $id;
            $delModel->delete();
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("Product Deleted SuccessFully !!");
            } else {
                $this->getMessage()->setFailure("Error While Deleting Data!!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
}
