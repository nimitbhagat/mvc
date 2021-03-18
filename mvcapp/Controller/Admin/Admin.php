<?php

namespace Controller\Admin;

use Mage;
use Exception;
use Controller\Core\Admin as CoreAdmin;


Mage::loadClassByFileName('Controller\Core\Admin');

class Admin extends CoreAdmin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        $gridBlock = Mage::getBlock("Block\Admin\Admin\Grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }
    public function formAction()
    {

        $form = Mage::getBlock('Block\Admin\Admin\Edit');
        $layout = $this->getLayout();
        $adminTab = Mage::getBlock("Block\Admin\Admin\Edit\Tabs");

        $layout->getChild('Sidebar')->addChild($adminTab, 'Tab');

        $layout->getChild('Content')->addChild($form, 'Grid');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $admin = Mage::getModel("Model\AdminModel");

            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request");
            }
            $adminId = $this->getRequest()->getGet('id');
            if ($adminId) {
                $admin =  $admin->load($adminId);
                if (!$admin) {
                    throw new Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Admin Updated Successfully !!");
            } else {
                $this->getMessage()->setSuccess("Admin Inserted Successfully !!");
            }
            $adminData = $this->getRequest()->getPost('admin');

            if (!array_key_exists('status', $adminData)) {
                $adminData['status'] = 0;
            } else {
                $adminData['status'] = 1;
            }

            $admin->setData($adminData);
            $admin->createdDate = date("Y-m-d H:i:s");
            $admin->save();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
    public function changeStatusAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');
            $st = $this->getRequest()->getGet('status');
            $model = Mage::getModel('Model\AdminModel');
            $model->id = $id;
            $model->status = $st;
            $model->changeStatus();
            if ($model->changeStatus()) {
                $this->getMessage()->setSuccess("Admin Status Change Successfully !!");
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
                throw new Exception("Invalid Request");
            }

            $id = $this->getRequest()->getGet('id');
            $delModel = Mage::getModel('Model\AdminModel');
            $delModel->id = $id;
            $delModel->delete();
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("Admin Deleted Successfully !!");
            } else {
                $this->getMessage()->setFailure("Unable To Delete Admin !!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
}
