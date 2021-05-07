<?php

namespace Block\Admin\Category;

use Mage;
use Block\Core\Grid as CoreGrid;

class Grid extends CoreGrid
{

    protected $categories = [];
    protected $categoryOptions = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/category/grid.php');
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
    }

    public function prepareColumns()
    {
        $this->addColumn(
            'categoryId',
            [
                'field' => 'categoryId',
                'label' => 'Category Id',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'name',
            [
                'field' => 'name',
                'label' => 'Category Name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'parentId',
            [
                'field' => 'parentId',
                'label' => 'Parent Id',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'pathId',
            [
                'field' => 'pathId',
                'label' => 'Path Id',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'description',
            [
                'field' => 'description',
                'label' => 'Description',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'status',
            [
                'field' => 'status',
                'label' => 'Status',
                'type' => 'text'
            ]
        );
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

        $query = "Select * from `category`";
        if ($this->getFilter()->hasFilters()) {
            $query .= " Where 1=1 ";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= "AND `{$key}` LIKE '%{$value}%'";
                    }
                }
            }
        }
        $query .= " LIMIT {$start},{$recordPerPage}";

        return $categorys->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `category`";
        if ($this->getFilter()->hasFilters()) {
            $query .= " Where 1=1 ";
            foreach ($this->getFilter()->getFilters() as $type => $filters) {
                if ($type == 'text') {
                    foreach ($filters as $key => $value) {
                        $query .= "AND `{$key}` LIKE '%{$value}%'";
                    }
                }
            }
        }

        $category = Mage::getModel('Model\Category');

        $records = $category->getAdapter()->fetchOne($query);

        $this->getPager()->setTotalRecords($records);
        $this->getPager()->setRecordPerPage(5);

        $page = $this->getRequest()->getGet('page');

        if (!$page) {
            $page = 1;
        }
        $this->getPager()->setCurrentPage($page);

        $this->getPager()->calculate();

        return $this;
    }

    public function prepareActions()
    {
        $this->addAction(
            'edit',
            [
                'label' => 'Edit',
                'class' => 'fa fa-pencil btn-info btn',
                'method' => 'getEditUrl',
            ]
        );

        $this->addAction(
            'delete',
            [
                'label' => 'Delete',
                'class' => 'fa fa-trash btn-danger btn',
                'method' => 'getDeleteUrl',
            ]
        );
    }

    public function prepareButtons()
    {
        $this->addButton(
            'addnew',
            [
                'label' => 'Add Category',
                'method' => 'getAddNewUrl',
                'icon' => 'fa fa-plus'
            ]
        );
    }

    public function getEditUrl($row)
    {
        return $this->getUrl()->getUrl('form', null, ['id' => $row->categoryId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl()->getUrl('delete', null, ['id' => $row->categoryId]);
    }
}
