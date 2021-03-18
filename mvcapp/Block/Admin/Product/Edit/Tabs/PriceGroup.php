<?php

namespace Block\Admin\Product\Edit\Tabs;

use Block\Core\Template;
use Mage;

//Mage::loadClassByFileName("block_core_template");
class PriceGroup extends Template
{
    protected $product = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/product/edit/tabs/priceGroup.php");
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct()
    {
    }

    public function getPriceGroup($id)
    {
        $customerGroupmodel = Mage::getModel('Model\PriceGroupModel');
        $productModel = Mage::getModel('Model\ProductModel');

        $product = $productModel->load($this->getRequest()->getGet('id'));

        $query = "SELECT cg.groupId,cg.name,pcgp.entityId,pcgp.groupPrice,
                    if(p.price IS NULL,{$product->price},p.price) as 'price'
                    FROM customergroup cg
                    LEFT JOIN product_customer_group_price pcgp
                        ON pcgp.customerGroupId=cg.groupId
                            AND pcgp.productId={$product->productId}
                    LEFT JOIN product p
                        ON pcgp.productId=p.productId";
        $priceGroup = $customerGroupmodel->fetchAll($query);

        return $priceGroup;
    }
}
