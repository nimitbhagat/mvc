<?php

namespace Controller\Admin;


use Mage;
use Exception;
use Controller\Core\Admin;

Mage::loadClassByFileName('Controller\Core\Admin');


class Media extends \Controller\Core\Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function saveAction()
    {

        try {
            if (isset($_FILES['image'])) {

                foreach ($_FILES['image']['tmp_name'] as $key => $value) {
                    $file_name = $_FILES['image']['name'][$key];

                    $file_tmp = $_FILES['image']['tmp_name'][$key];
                    $file_type = $_FILES['image']['type'][$key];

                    $tmp = explode('.', $file_name);

                    $file_ext = strtolower(end($tmp));

                    $extensions = array("jpeg", "jpg", "png", "webp");

                    if (in_array($file_ext, $extensions) === false) {
                        $this->getMessage()->setFailure("Some Image Uploading Fail Due To Unsupported Extension");
                        continue;
                        //throw new Exception("extension not allowed, please choose a WEBP,JPEG or PNG file.");
                    }

                    $dir = './Media/images/Products/' . $this->getRequest()->getGet('id');



                    if (!file_exists($dir) && !is_dir($dir)) {
                        mkdir($dir);
                    }

                    if (move_uploaded_file($file_tmp, "{$dir}/" . $file_name)) {
                        //rename("./Media/images/Products/.{$file_name}", "./Media/Products/images/.{$key}");
                        $Media = Mage::getModel("Model\Media");
                        $Media->productId = $this->getRequest()->getGet('id');
                        $Media->imageName = $file_name;
                        if (!$Media->save()) {
                            $this->getMessage()->setFailure("Some Image Uploading Fail");
                            continue;
                            //throw new Exception("Image Uploading Fail", 1);
                        }
                        $this->getMessage()->setSuccess("File Uploaded Successfully");
                    }
                }
            }
        } catch (Exception $e) {
            //print_r("ERROR");
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', 'admin\product', null, false);
    }

    public function checkAction()
    {
        try {

            if (!$this->getRequest()->getGet('id')) {
                $this->redirect('grid', 'product', null, true);
            }

            if (array_key_exists('update', $this->getRequest()->getPost())) {
                $imageData = $this->getRequest()->getPost('image');
                if ($imageData) {
                    $small = "";
                    $thumb = "";
                    $base = "";

                    if (array_key_exists('small', $imageData)) {
                        $small = $imageData['small'];
                        unset($imageData['small']);
                    }
                    if (array_key_exists('thumb', $imageData)) {
                        $thumb = $imageData['thumb'];
                        unset($imageData['thumb']);
                    }
                    if (array_key_exists('base', $imageData)) {
                        $base = $imageData['base'];
                        unset($imageData['base']);
                    }

                    foreach ($imageData as $key => $value) {
                        if (array_key_exists('remove', $value)) {
                            unset($value['remove']);
                        }

                        if ($key == $small) {
                            $value['small'] = 1;
                        }

                        if ($key == $base) {
                            $value['base'] = 1;
                        }

                        if ($key == $thumb) {
                            $value['thumb'] = 1;
                        }



                        if (!array_key_exists('base', $value)) {
                            $value['base'] = 0;
                        }
                        if (!array_key_exists('small', $value)) {
                            $value['small'] = 0;
                        }
                        if (!array_key_exists('thumb', $value)) {
                            $value['thumb'] = 0;
                        }

                        if (!array_key_exists('gallery', $value)) {
                            $value['gallery'] = 0;
                        } else {
                            $value['gallery'] = 1;
                        }

                        unset($value['imageType']);

                        $values = array_values($value);
                        $fields = array_keys($value);
                        $final = null;

                        for ($i = 0; $i < count($fields); $i++) {
                            if ($fields[$i] == $key) {
                                $id = $values[$i];
                                continue;
                            }
                            $final = $final . "`" . $fields[$i] . "`='" . $values[$i] . "',";
                        }
                        $final = rtrim($final, ",");

                        $query = "UPDATE `productmedia` SET {$final} WHERE `mediaId` = '{$key}'";

                        $upModel = Mage::getModel('Model\Media');
                        if ($upModel->update($query)) {
                            $this->getMessage()->setSuccess("Update Changes Successfully !!");
                        }
                    }
                }
            } else {
                $keys = [];

                $imageData = $this->getRequest()->getPost('image');
                if (array_key_exists('base', $imageData)) {
                    unset($imageData['base']);
                }
                if (array_key_exists('small', $imageData)) {
                    unset($imageData['small']);
                }
                if (array_key_exists('thumb', $imageData)) {
                    unset($imageData['thumb']);
                }

                foreach ($imageData as $key => $value) {
                    if (array_key_exists('remove', $value)) {
                        $keys[] = $key;
                    }
                }

                if (!$keys) {
                    throw new Exception("Please Select The Image", 1);
                }

                $Media = Mage::getModel('Model\Media');
                echo $query = "SELECT imageName from productmedia  where mediaId IN (" . implode(',', $keys) . ")";

                $filenames = $Media->fetchAll($query);

                $id = $this->getRequest()->getGet('id');
                foreach ($filenames->getData() as $key => $value) {
                    unlink("./Media/images/Products/{$id}/{$value->imageName}");
                }

                $query = "delete from productmedia  where mediaId IN (" . implode(',', $keys) . ")";
                $Media->delete($query);
                if ($Media->delete($query)) {
                    $this->getMessage()->setSuccess("Product Images Delete For Product !!");
                } else {
                    throw new Exception("Unable To Delete Product Image !!", 1);
                    //$this->getMessage()->setSuccess("Unable To Delete Product Image !!");
                }
            }
        } catch (Exception $e) {
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', 'admin\product', null, false);
    }
}
