<?php

namespace Block\Admin\Category;

use Mage;

Mage::loadClassByFileName('Block\Core\Template');

class Grid extends \Block\Core\Template
{

    protected $categories = [];
    protected $categoryOptions = [];

    public function __construct()
    {
        $this->setTemplate('./admin/category/grid.php');
    }

    public function setCategories($categories = null)
    {
        if (!$categories) {
            $categories = Mage::getModel("Model\Category");
            $categories = $categories->fetchAll();
        }
        $this->categories = $categories;
        return $this;
    }

    public function getCategories()
    {
        if (!$this->categories) {
            $this->setCategories();
        }
        return $this->categories;
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



    public function getTitle()
    {
        return "Manage Categories";
    }

    public function getName($category)
    {

        $categoryModel = Mage::getModel('Model\Category');

        if (!$this->categoryOptions) {
            $query = "select `categoryId`,`name` from `{$categoryModel->getTableName()}`";
            $this->categoryOptions = $categoryModel->getAdapter()->fetchPairs($query);
        }

        $pathIds = explode("=", $category->pathId);
        foreach ($pathIds as $key => &$id) {
            if (array_key_exists($id, $this->categoryOptions)) {
                $id = $this->categoryOptions[$id];
            }
        }
        $name = implode("/", $pathIds);
        return $name;
    }

    public function getPaginationCategory()
    {
        $categorys = Mage::getModel("Model\Category");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }
        $query = "SELECT * from category LIMIT {$start},{$recordPerPage}";
        return $categorys->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `category`";
        $category = Mage::getModel('Model\Category');

        $records = $category->getAdapter()->fetchOne($query);

        $this->getPager()->setTotalRecords($records);
        $this->getPager()->setRecordPerPage(10);

        $page = $this->getRequest()->getGet('page');

        if (!$page) {
            $page = 1;
        }
        $this->getPager()->setCurrentPage($page);

        $this->getPager()->calculate();

        return $this;
    }
}
