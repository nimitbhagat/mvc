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
                echo "<pre>";
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

                foreach ($data['new'] as $key => $value) {


                    /*
                    if ($name) {
                        $configuration = Mage::getModel("Model\Attribute\Option");
                        $configuration->groupId  = $groupId;
                        $configuration->title = "$name";
                        $configuration->code = "$sortOrder";
                        $configuration->value = "$sortOrder";
                        if ($configuration->save()) {
                            $this->getMessage()->setSuccess("Option Updated SuccessFully !!");
                        }
                    }
                    */
                }
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }

        $this->redirectToPrevious();
        //$this->redirect('grid', null, null, true);
    }


    public function deleteAction()
    {
        try {
            if ($this->request->isPost()) {
                throw new Exception("Invalid Request");
            }

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
        $this->redirectToPrevious();
    }
}
