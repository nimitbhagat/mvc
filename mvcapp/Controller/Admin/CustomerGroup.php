<?php

namespace Controller\Admin;

use Mage;
use Exception;
use Controller\Core\Admin;

Mage::loadClassByFileName('Controller\Core\Admin');


class CustomerGroup extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {

        $gridBlock = Mage::getBlock("Block\Admin\CustomerGroup\Grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }
    public function formAction()
    {
        $layout = $this->getLayout();

        $form = Mage::getBlock('Block\Admin\CustomerGroup\Edit');
        $layout->getChild('Content')->addChild($form, 'Grid');

        $tab = Mage::getBlock("Block\Admin\CustomerGroup\Edit\Tabs");
        $layout->getChild('Sidebar')->addChild($tab, 'Tab');

        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $customerGroup = Mage::getModel("Model\CustomerGroup");
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request");
            }
            echo $customerGroupId = $this->getRequest()->getGet('id');
            if (!$customerGroupId) {
                $customerGroup->createdDate = date("Y-m-d H:i:s");
                $this->getMessage()->setSuccess("Customer Group Inserted Successfully");
            } else {
                $customerGroup =  $customerGroup->load($customerGroupId);
                if (!$customerGroup) {
                    throw new Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Customer Group Updated Successfully");
            }


            $customerGroupData = $this->getRequest()->getPost('customerGroup');

            $customerGroup->setData($customerGroupData);

            if ($customerGroup->save()) {
                throw new Exception("Operation Failed");
            }
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
            $customerGroup = Mage::getModel('Model\CustomerGroup');
            $customerGroup->id = $id;
            $customerGroup->status = $st;
            $customerGroup->changeStatus();
            if ($customerGroup->changeStatus()) {
                $this->getMessage()->setSuccess("Customer Group Status Updated Successfully");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailed($e->getMessage());
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
            $delModel = Mage::getModel('Model\CustomerGroup');
            $delModel->id = $id;
            $delModel->delete();
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("Customer Group Deleted SuccessFully !!");
            } else {
                $this->getMessage()->setFailure("Unable to Delete Customer Group!!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
}
