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
        try {
            $gridBlock = Mage::getBlock("Block\Admin\CustomerGroup\Grid")->toHtml();

            $response = [
                'element' => [
                    [
                        'selector' => '#ContentGrid',
                        'html' => $gridBlock
                    ]
                ]
            ];

            header('content-type: application/json');
            echo json_encode($response);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
    public function formAction()
    {
        try {
            $edit = Mage::getBlock('Block\Admin\CustomerGroup\Edit');
            $admin = \Mage::getModel('Model\Admin');
            if ($id = $this->getRequest()->getGet('id')) {
                $admin->load($id);
                if (!$admin) {
                    throw new Exception("Product data not found", 1);
                }
            }
            $edit->setTableRow($admin);


            $edithtml = $edit->toHtml();


            $response = [
                'element' => [
                    [
                        'selector' => '#ContentGrid',
                        'html' => $edithtml
                    ]
                ]
            ];

            header("content-type: application/json");
            echo json_encode($response);
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect("grid", null, null, true);
        }
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
            $id = $this->getRequest()->getGet('id');
            $delModel = Mage::getModel('Model\CustomerGroup');
            $delModel->groupId = $id;
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

    public function filterAction()
    {
        try {
            $filters = $this->getRequest()->getPost('filter');


            $filterModel = Mage::getModel('Model\Admin\Filter');
            $filterModel->setFilters($filters);

            $gridBlock = Mage::getBlock("Block\Admin\CustomerGroup\Grid")->setFilter($filterModel)->toHtml();

            $response = [
                'element' => [
                    [
                        'selector' => '#ContentGrid',
                        'html' => $gridBlock
                    ]
                ]
            ];

            header('content-type: application/json');
            echo json_encode($response);
        } catch (\Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
}
