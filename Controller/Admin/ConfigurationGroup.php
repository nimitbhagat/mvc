<?php

namespace Controller\Admin;

use Mage;
use Exception;
use Controller\Core\Admin as CoreAdmin;


Mage::loadClassByFileName('Controller\Core\Admin');

class ConfigurationGroup extends CoreAdmin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        try {
            $gridBlock = Mage::getBlock("Block\Admin\ConfigurationGroup\Grid")->toHtml();

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
            $edit = Mage::getBlock('Block\Admin\ConfigurationGroup\Edit');
            $configGroup = Mage::getModel('Model\ConfigurationGroup');
            if ($id = $this->getRequest()->getGet('id')) {
                $configGroup->load($id);
                if (!$configGroup) {
                    throw new Exception("Config data not found", 1);
                }
            }
            $edit->setTableRow($configGroup);


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
            $configurationGroup = Mage::getModel("Model\ConfigurationGroup");

            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request");
            }
            $configurationGroupId = $this->getRequest()->getGet('id');
            if ($configurationGroupId) {
                $configurationGroup =  $configurationGroup->load($configurationGroupId);
                if (!$configurationGroup) {
                    throw new Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Configuration Group Updated Successfully !!");
            } else {
                $this->getMessage()->setSuccess("Configuration Group Inserted Successfully !!");
            }
            $configurationGroupData = $this->getRequest()->getPost('config_group');

            $configurationGroup->setData($configurationGroupData);
            $configurationGroup->createdDate = date("Y-m-d H:i:s");
            $configurationGroup->save();
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');
            $delModel = Mage::getModel('Model\ConfigurationGroup');
            $delModel->groupId = $id;
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("Configuration Group Deleted Successfully !!");
            } else {
                $this->getMessage()->setFailure("Unable To Delete Configuration Group !!");
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

            $gridBlock = Mage::getBlock("Block\Admin\ConfigurationGroup\Grid")->setFilter($filterModel)->toHtml();

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
