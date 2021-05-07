<?php

namespace Controller\Admin\ConfigurationGroup;

use Mage;
use Exception;
use Controller\Core\Admin as CoreAdmin;


Mage::loadClassByFileName('Controller\Core\Admin');

class Configuration extends CoreAdmin
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
            $data = $this->getRequest()->getPost();

            $groupId = $this->getRequest()->getGet('id');

            if (array_key_exists('existing', $data)) {
                foreach ($data['existing'] as $configId => $configValue) {
                    $configuration = Mage::getModel("Model\ConfigurationGroup\Configuration");
                    $query = "Update `config` set `title`= '{$configValue['title']}', `code`='{$configValue['code']}', `value`='{$configValue['value']}' where  `groupId`={$groupId} and `configId`={$configId}";

                    if ($configuration->update($query)) {
                        $this->getMessage()->setSuccess("Option Updated SuccessFully !!");
                    }
                }
            }

            if (array_key_exists('new', $data)) {
                array_map(function ($title, $code, $value) {
                    if (($title != null && $title != "") && ($title != null && $title != "") && ($value != null && $value != "")) {
                        $configuration = Mage::getModel("Model\ConfigurationGroup\Configuration");
                        $configuration->groupId = $this->getRequest()->getGet('id');
                        $configuration->title = $title;
                        $configuration->code = $code;
                        $configuration->value = $value;
                        $configuration->save();
                    }
                }, $data['new']['title'], $data['new']['code'], $data['new']['value']);
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', 'admin\ConfigurationGroup');
    }


    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('configId');
            $delModel = Mage::getModel('Model\ConfigurationGroup\Configuration');
            $delModel->configId = $id;
            $delModel->delete();
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("Configuration Deleted Successfully !!");
            } else {
                $this->getMessage()->setFailure("Unable To Delete Configuration !!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', 'admin\ConfigurationGroup');
    }
}
