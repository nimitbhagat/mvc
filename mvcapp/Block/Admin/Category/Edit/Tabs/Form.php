<?php

namespace Block\Admin\Category\Edit\Tabs;

use Mage;
use Block\Core\Template;

Mage::loadClassByFileName("Block\Core\Template");

class Form extends \Block\Core\Template
{
    protected $categories = null;
    protected $categoryOptions = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate("./admin/category/edit/tabs/form.php");
    }

    public function setCategory($categories = null)
    {
        if (!$categories) {
            $categories = Mage::getModel("Model\Category");
            if ($id = $this->getRequest()->getGet('id')) {
                $category = $categories->load($id);
                if (!$category) {
                    return null;
                }
            }
        }
        $this->categories = $categories;
        return $this;
    }
    public function getCategory()
    {
        if (!$this->categories) {
            $this->setCategory();
        }
        return $this->categories;
    }

    public function getCategoryOptions()
    {
        if (!$this->categoryOptions) {

            $query = "select `categoryId`,`name` from {$this->getCategory()->getTableName()}";
            $options = $this->getCategory()->getAdapter()->fetchPairs($query);

            $query = "select `categoryId`,`pathId` from {$this->getCategory()->getTableName()} WHERE pathId NOT LIKE '{$this->getCategory()->pathId}' ORDER BY `pathId` ASC";
            $this->categoryOptions = $this->getCategory()->getAdapter()->fetchPairs($query);

            foreach ($this->categoryOptions as $categoryId => &$pathId) {
                $pathIds = explode("=", $pathId);
                foreach ($pathIds as $key => &$id) {
                    if (array_key_exists($id, $options)) {
                        $id = $options[$id];
                    }
                }
                $pathId = implode("/", $pathIds);
            }

            $this->categoryOptions = ["" => "Root Category"] + $this->categoryOptions;
        }

        return $this->categoryOptions;
    }
}
