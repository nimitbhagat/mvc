<?php

namespace Controller\Admin;

use Controller\Core\Admin;
use Exception;
use Mage;

Mage::loadClassByFileName('Controller\Core\Admin');

class Attribute extends Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        $gridBlock = Mage::getBlock("Block\Admin\Attribute\Grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");
        $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        $this->renderLayout();
    }
    public function formAction()
    {

        $layout = $this->getLayout();

        $attributeTab = Mage::getBlock("Block\Admin\Attribute\Edit\Tabs");
        $layout->getChild('Sidebar')->addChild($attributeTab, 'Tab');

        $form = Mage::getBlock('Block\Admin\Attribute\Edit');
        $layout->getChild('Content')->addChild($form, 'Grid');

        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $attribute = Mage::getModel("Model\Attribute");
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request", 1);
            }
            $attributeId = $this->getRequest()->getGet('id');
            $attributeData = $this->getRequest()->getPost('attribute');

            if (!$attributeId) {
                $attribute->setData($attributeData);

                if ($attribute->save()) {

                    $modelname = 'Model\\' . $attributeData['entityTypeId'] . "Model";

                    $model = Mage::getModel($modelname);
                    $query = "ALTER TABLE `{$attributeData['entityTypeId']}` ADD `{$attributeData['name']}` {$attributeData['backendType']} NOT NULL;";

                    if (!$model->alterTable($query)) {
                        throw new Exception("Error!!", 1);
                    }

                    $this->getMessage()->setSuccess("Attribute Inserted SuccessFully !!");
                } else {
                    throw new Exception("Insertion Error");
                }
            } else {
                $attribute =  $attribute->load($attributeId);
                if (!$attribute) {
                    throw new Exception("Data Not Found", 1);
                }
                $attribute->setData($attributeData);

                $attribute->attributeId = $attributeId;

                if ($attribute->save()) {
                    $this->getMessage()->setSuccess("Attribute Updated SuccessFully !!");
                } else {
                    throw new Exception("Update Error");
                }
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
                throw new Exception("Invalid Request", 1);
            }

            $id = $this->getRequest()->getGet('id');

            //$delModel->delete();
            $delModel = Mage::getModel('Model\Attribute');

            $attributeData = $delModel->load($id);
            $modelname = 'Model\\' . $attributeData->entityTypeId . "Model";

            $model = Mage::getModel($modelname);
            $query = "ALTER TABLE `{$attributeData->entityTypeId}` DROP `{$attributeData->name}`;";

            if ($model->alterTable($query)) {
                $delModel->id = $id;

                if ($delModel->delete()) {
                    $this->getMessage()->setSuccess("Attribute Deleted SuccessFully!!");
                }
            } else {
                $this->getMessage()->setFailure("Error While Deleting Data!!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            die();
        }
        $this->redirect('grid', null, null, true);
    }

    public function optionAction()
    {
        $attribute = Mage::getModel('Model\Attribute');
        $id = $this->getRequest()->getGet('id');
    }
}
