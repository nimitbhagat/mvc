<?php

namespace Block\Admin\Product\Edit\Tabs;

use Block\Core\Template;
use Mage;

//Mage::loadClassByFileName("Block\Core\Template");

class Media extends Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/media.php");
    }

    public function getMedia($id)
    {
        $mediaModel = Mage::getModel("Model\Media");
        $query = "select * from `productmedia` where `productId` =" . $id;
        $media = $mediaModel->fetchAll($query);
        return $media;
    }
}
