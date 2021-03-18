<?php

namespace Block\Admin\Product\Edit\Tabs;

use Mage;
use Block\Core\Template;


Mage::loadClassByFileName("Block\Core\Template");
class Media extends \Block\Core\Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/media.php");
    }

    public function getMedia($id)
    {
        $mediaModel = Mage::getModel("Model\MediaModel");
        $query = "select * from `productmedia` where `productId` =" . $id;
        $media = $mediaModel->fetchAll($query);
        return $media;
    }
}
