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
        try {
            $gridBlock = Mage::getBlock("Block\Admin\Admin\Grid")->toHtml();

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
            $edit = Mage::getBlock('Block\Admin\Admin\Edit');
            $admin = Mage::getModel('Model\Admin');
            if ($id = $this->getRequest()->getGet('id')) {
                $admin->load($id);
                if (!$admin) {
                    throw new Exception("Admin data not found", 1);
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
            $admin = Mage::getModel("Model\Admin");

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
            $model = Mage::getModel('Model\Admin');
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
            $id = $this->getRequest()->getGet('id');
            $delModel = Mage::getModel('Model\Admin');
            $delModel->adminId = $id;
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

    public function filterAction()
    {
        try {
            $filters = $this->getRequest()->getPost('filter');


            $filterModel = Mage::getModel('Model\Admin\Filter');
            $filterModel->setFilters($filters);

            $gridBlock = Mage::getBlock("Block\Admin\Admin\Grid")->setFilter($filterModel)->toHtml();

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
