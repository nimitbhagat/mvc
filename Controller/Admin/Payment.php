<?php

namespace Controller\Admin;

use Mage;
use Exception;
use Controller\Core\Admin;

Mage::loadClassByFileName('Controller\Core\Admin');

class Payment extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        try {
            $gridBlock = Mage::getBlock("Block\Admin\Payment\Grid")->toHtml();

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
            $edit = \Mage::getBlock('Block\Admin\Payment\Edit');
            $payment = \Mage::getModel('Model\Payment');
            if ($id = $this->getRequest()->getGet('id')) {
                $payment->load($id);
                if (!$payment) {
                    throw new Exception("Payment data not found", 1);
                }
            }
            $edit->setTableRow($payment);


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
            $payment = Mage::getModel("Model\Payment");
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request");
            }
            $paymentId = $this->getRequest()->getGet('id');
            if (!$paymentId) {

                $payment->createdDate = date("Y-m-d H:i:s");
                $this->getMessage()->setSuccess("Payment Done !!");
            } else {
                $payment =  $payment->load($paymentId);
                if (!$payment) {
                    throw new Exception("Data Not Found");
                }
                $this->getMessage()->setSuccess("Payment Updated !!");
            }

            $paymentData = $this->getRequest()->getPost('payment');

            if (!array_key_exists('status', $paymentData)) {
                $paymentData['status'] = 0;
            } else {
                $paymentData['status'] = 1;
            }

            $payment->setData($paymentData);
            $payment->save();
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
            $model = Mage::getModel('model\Payment');
            $model->paymentId = $id;
            $model->status = $st;

            if (!$model->changeStatus()) {
                throw new Exception("Status Change Failed!!");
            }
            $this->getMessage()->setSuccess("Payment Status Updated !!");
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }

    public function deleteAction()
    {
        try {
            $id = $this->getRequest()->getGet('id');
            $delModel = Mage::getModel('Model\Payment');
            $delModel->paymentId = $id;
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("Payment Deleted !!");
            } else {
                $this->getMessage()->setFailure("Unable To Delete Payment !!");
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

            $gridBlock = Mage::getBlock("Block\Admin\Payment\Grid")->setFilter($filterModel)->toHtml();

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
