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
        $gridBlock = Mage::getBlock("Block\Admin\ConfigurationGroup\Grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }

    public function formAction()
    {
        $form = Mage::getBlock('Block\Admin\ConfigurationGroup\Edit');
        $layout = $this->getLayout();
        $configurationGroupTab = Mage::getBlock("Block\Admin\ConfigurationGroup\Edit\Tabs");

        $layout->getChild('Sidebar')->addChild($configurationGroupTab, 'Tab');

        $layout->getChild('Content')->addChild($form, 'Grid');
        $this->renderLayout();
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
            if ($this->request->isPost()) {
                throw new Exception("Invalid Request");
            }

            $id = $this->getRequest()->getGet('id');
            $delModel = Mage::getModel('Model\ConfigurationGroup');
            $delModel->groupId = $id;
            $delModel->delete();
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
        $filters = $this->getRequest()->getPost('filter');

        $filterModel = Mage::getModel('Model\Admin\Filter');
        $filterModel->setFilters($filters);



        $gridBlock = Mage::getBlock("Block\Admin\ConfigurationGroup\Grid")->setFilter($filterModel);
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();

        //print_r($_SESSION);
    }
}
