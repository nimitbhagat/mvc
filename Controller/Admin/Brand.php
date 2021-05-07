<?php

namespace Controller\Admin;

use Mage;
use Exception;
use Controller\Core\Admin;

Mage::loadClassByFileName('Controller\Core\Admin');

class Brand extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function gridAction()
    {
        try {
            $gridBlock = Mage::getBlock("Block\Admin\Brand\Grid")->toHtml();

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

        // $gridBlock = Mage::getBlock("Block\Admin\Brand\grid");
        // $layout = $this->getLayout();
        // $layout->setTemplate("./core/layout/one_column.php");
        // $layout->getChild("Content")->addChild($gridBlock, 'Grid');
        // $this->renderLayout();
    }
    public function formAction()
    {

        try {
            $edit = \Mage::getBlock('Block\Admin\Brand\Edit');
            $admin = \Mage::getModel('Model\Brand');
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
            $brand = Mage::getModel("Model\Brand");
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Post Request", 1);
            }
            $brandId = $this->getRequest()->getGet('id');

            if (!$brandId) {
                if ($_FILES['image']['name']) {
                    $file_name = $_FILES['image']['name'];

                    $file_tmp = $_FILES['image']['tmp_name'];
                    $file_type = $_FILES['image']['type'];

                    $tmp = explode('.', $file_name);

                    $file_ext = strtolower(end($tmp));

                    $extensions = array("png");

                    if (in_array($file_ext, $extensions) === false) {
                        throw new Exception("extension not allowed, please choose a PNG file.");
                    }

                    $brand->createdDate = date("Y-m-d H:i:s");

                    $brandData = $this->getRequest()->getPost('brand');

                    foreach ($brandData as $key => $value) {
                        if (is_array($value)) {
                            $value = implode(',', $value);
                            $brandData[$key] = $value;
                        }
                    }

                    $brandData['image'] = $file_name;


                    if (!array_key_exists('status', $brandData)) {
                        $brandData['status'] = 0;
                    } else {
                        $brandData['status'] = 1;
                    }
                    $brand->setData($brandData);

                    if (!$id = $brand->save()) {
                        throw new Exception("Error In Insertion", 1);
                    }


                    $id = $id->getAdapter()->getConnect()->insert_id;

                    $dir = './Media/images/Brand/' . $id;

                    if (!file_exists($dir) && !is_dir($dir)) {
                        mkdir($dir);
                    }

                    if (!move_uploaded_file($file_tmp, "{$dir}/" . $file_name)) {
                        throw new Exception("Image Upload Failed In Insertion", 1);
                    }
                    $this->getMessage()->setSuccess("Brand Inserted SuccessFully !!");
                } else {
                    throw new Exception("Please Upload Image", 1);
                }
            } else {
                $brand =  $brand->load($brandId);
                if (!$brand) {
                    throw new Exception("Data Not Found", 1);
                }
                if ($_FILES['image']['name']) {
                    $file_name = $_FILES['image']['name'];

                    $file_tmp = $_FILES['image']['tmp_name'];
                    $file_type = $_FILES['image']['type'];

                    $tmp = explode('.', $file_name);

                    $file_ext = strtolower(end($tmp));

                    $extensions = array("png");

                    if (in_array($file_ext, $extensions) === false) {
                        throw new Exception("extension not allowed, please choose a PNG file.");
                    }

                    $dir = './Media/images/Brand/' . $brandId;


                    if (!file_exists($dir) && !is_dir($dir)) {
                        mkdir($dir);
                    }

                    if (move_uploaded_file($file_tmp, "{$dir}/" . $file_name)) {
                        $this->removeImage($brandId, $brand->image);
                        $brand->image = $file_name;
                    }
                }

                $brand->brandId = $brandId;
                $brandData = $this->getRequest()->getPost('brand');

                foreach ($brandData as $key => $value) {
                    if (is_array($value)) {
                        $value = implode(',', $value);
                        $brandData[$key] = $value;
                    }
                }

                if (!array_key_exists('status', $brandData)) {
                    $brandData['status'] = 0;
                } else {
                    $brandData['status'] = 1;
                }
                $brand->setData($brandData);


                if (!$brand->save()) {
                    throw new Exception("Error In Update", 1);
                }
                $this->getMessage()->setSuccess("Brand Updated SuccessFully !!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
            $this->redirect('form', null, null, false);
        }
        $this->redirect('grid', null, [], true);
    }

    public function changeStatusAction()
    {
        try {

            $id = $this->getRequest()->getGet('id');
            $st = $this->getRequest()->getGet('status');
            $model = Mage::getModel('Model\Brand');
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
            $delModel = Mage::getModel('Model\Brand');
            $delModel->brandId = $id;
            $delModel->delete();
            if ($delModel->delete()) {
                $this->getMessage()->setSuccess("Brand Deleted !!");
                $this->removeImage($id);
            } else {
                $this->getMessage()->setFailure("Unable To Delete Brand !!");
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('grid', null, null, true);
    }

    public function removeImage($id, $imageName = null)
    {
        if (!$imageName) {


            $files = scandir("./Media/images/Brand/{$id}");
            unset($files[0]);
            unset($files[1]);

            foreach ($files as $value) {
                unlink("./Media/images/Brand/{$id}/{$value}");
            }

            rmdir("./Media/images/Brand/{$id}");

            return true;
        }

        if (unlink("./Media/images/Brand/{$id}/{$imageName}")) {
            return true;
        }
        return false;
    }

    public function filterAction()
    {
        try {
            $filters = $this->getRequest()->getPost('filter');


            $filterModel = Mage::getModel('Model\Admin\Filter');
            $filterModel->setFilters($filters);

            $gridBlock = Mage::getBlock("Block\Admin\Brand\Grid")->setFilter($filterModel)->toHtml();

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
