<?php

namespace Controller\Admin;

use Mage;
use Exception;
use Controller\Core\Admin;

Mage::loadClassByFileName('Controller\Core\Admin');

class Category extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");

        $gridBlock = Mage::getBlock("Block\Admin\Category\Grid");
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');

        $this->renderLayout();
    }

    public function editAction()
    {
        try {
            if (!($id = $this->getRequest()->getGet('id'))) {
                throw new Exception("Id Not Found", 1);
            }

            $layout = $this->getLayout();

            $categoryTab = Mage::getBlock("Block\Admin\Category\Edit\Tabs");
            $layout->getChild('Sidebar')->addChild($categoryTab, 'Tab');

            $form = Mage::getBlock('Block\Admin\Category\Edit');
            $layout->getChild('Content')->addChild($form, 'Grid');

            $this->renderLayout();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('grid');
        }
    }

    public function formAction()
    {
        $layout = $this->getLayout();

        $categoryTab = Mage::getBlock("Block\Admin\Category\Edit\Tabs");
        $layout->getChild('Sidebar')->addChild($categoryTab, 'Tab');

        $form = Mage::getBlock('Block\Admin\Category\Edit');
        $layout->getChild('Content')->addChild($form, 'Grid');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request");
            }

            $category = Mage::getModel("Model\Category");

            if ($categoryId = $this->getRequest()->getGet('id')) {
                $category = $category->load($categoryId);
                if (!$category) {
                    throw new Exception("Invalid Id");
                }
            }

            $categoryPathId = $category->pathId;

            $postData = $this->getRequest()->getPost('category');
            $category->setData($postData);

            if (!array_key_exists('status', $postData)) {
                $categoryData['status'] = 0;
            } else {
                $categoryData['status'] = 1;
            }

            $category->save();

            $category->updatePathId();

            $category->updateChildrenPathIds($categoryPathId);
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->getMessage()->setSuccess("Category Inserted Successfully");

        $this->redirect('grid', null, null, true);
    }


    public function changeStatusAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');
            $st = $this->getRequest()->getGet('status');
            $model = Mage::getModel('Model\Category');
            $model->id = $id;
            $model->status = $st;
            $model->changeStatus();
            if ($model->changeStatus()) {
                $this->getMessage()->setSuccess("Status Changed Successfully");
            }
        } catch (Exception $e) {
            $this->getMessage()->setSuccess($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
    public function deleteAction()
    {
        try {
            $category = Mage::getModel('Model\Category');

            if ($id = $this->getRequest()->getGet('id')) {
                $category = $category->load($id);
                if (!$category) {
                    throw new Exception("Invalid ID");
                }
            }

            $pathId = $category->pathId;
            $parentId = $category->pathId;

            $category->updateChildrenPathIds($pathId, $parentId);
            $category->delete();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
}
