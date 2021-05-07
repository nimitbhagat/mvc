<?php

namespace Controller\Admin;

use Mage;
use Exception;
use Controller\Core\Admin;

Mage::loadClassByFileName('Controller\Core\Admin');

class Cms extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {

        try {
            $gridBlock = $gridBlock = Mage::getBlock("Block\Admin\Cms\Grid")->toHtml();

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
            $edit = Mage::getBlock('Block\Admin\Cms\Edit');

            $admin = Mage::getModel('Model\Cms');
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

            $cms = Mage::getModel("Model\Cms");
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request", 1);
            }
            $pageId = $this->getRequest()->getGet('id');

            if (!$pageId) {
                $cms->createdDate = date("Y-m-d H:i:s");

                $this->getMessage()->setSuccess("CMS PAGE Inserted SuccessFully !!");
            } else {
                $cms =  $cms->load($pageId);
                if (!$cms) {
                    throw new Exception("Data Not Found", 1);
                }
                $cms->pageId = $pageId;

                $this->getMessage()->setSuccess("CMS PAGE Updated SuccessFully !!");
            }

            $cmsData = $this->getRequest()->getPost('cms');


            if (!array_key_exists('status', $cmsData)) {
                $cmsData['status'] = 0;
            } else {
                $cmsData['status'] = 1;
            }

            $cms->setData($cmsData);

            $cms->save();
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
            $model = Mage::getModel('Model\Cms');
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

            $id = $this->getRequest()->getGet('id');

            $delModel = Mage::getModel('Model\Cms');
            $delModel->CmsId = $id;



            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("CMS PAGE Deleted SuccessFully !!");
            } else {
                $this->getMessage()->setFailure("Error While Deleting Page!!");
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

            $gridBlock = Mage::getBlock("Block\Admin\Cms\Grid")->setFilter($filterModel)->toHtml();

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
