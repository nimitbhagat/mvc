<?php

namespace Controller\Admin;

use Controller\Core\Admin;
use Exception;
use Mage;


//Mage::loadClassByFileName('Controller\Core\Admin');


class PriceGroup extends Admin
{

    public function __construct()
    {
        parent::__construct();
    }

    public function saveAction()
    {
        try {
            $this->getMessage()->setSuccess("File Uploaded Successfully");
        } catch (Exception $e) {
            //print_r("ERROR");
            $this->getMessage()->setFailure($e->getMessage());
        }
        $this->redirect('form', 'product', null, false);
    }
}
