<?php

namespace Controller\Admin;

use Controller\Core\Admin;
use Exception;
use Mage;

Mage::loadClassByFileName('Controller\Core\Admin');


class Shipment extends Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {

        $gridBlock = Mage::getBlock("Block\Admin\Shipment\Grid");
        $layout = $this->getLayout();
        $layout->setTemplate("./core/layout/one_column.php");

        $layout->getChild("Content")->addChild($gridBlock, 'Grid');

        $this->renderLayout();
    }

    public function formAction()
    {

        $form = Mage::getBlock('Block\Admin\Shipment\Edit');
        $layout = $this->getLayout();
        $shipmentTab = Mage::getBlock("Block\Admin\Shipment\Edit\Tabs");
        $layout->getChild('Sidebar')->addChild($shipmentTab, 'Tab');
        $layout->getChild('Content')->addChild($form, 'Grid');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $shipment = Mage::getModel("Model\ShipmentModel");
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request");
            }
            $shipmentId = $this->getRequest()->getGet('id');
            if (!$shipmentId) {
                $shipment->createdDate = date("Y-m-d H:i:s");
                $this->getMessage()->setSuccess("Shipment Inserted !!");
            } else {
                $shipment =  $shipment->load($shipmentId);
                if (!$shipment) {
                    throw new Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Shipment Updated !!");
            }

            $shipmentData = $this->getRequest()->getPost('shipment');

            if (!array_key_exists('status', $shipmentData)) {
                $shipmentData['status'] = 0;
            } else {
                $shipmentData['status'] = 1;
            }

            $shipment->setData($shipmentData);
            $shipment->save();
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
            $model = Mage::getModel('Model\ShipmentModel');
            $model->id = $id;
            $model->status = $st;
            $model->changeStatus();
            if ($model->changeStatus()) {
                $this->getMessage()->setSuccess("Shipment Status Updated !! ");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect("grid", null, null, true);
    }
    public function deleteAction()
    {
        try {
            if ($this->request->isPost()) {
                throw new Exception("Invalid Request");
            }

            $id = $this->getRequest()->getGet('id');
            $delModel = Mage::getModel('Model\ShipmentModel');
            $delModel->id = $id;
            $delModel->delete();
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("Shipment Deleted !! ");
            } else {
                $this->getMessage()->setSuccess("Unable To Delete Shipment !! ");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }
}
