<?php

namespace Block\Admin\Product;

use Mage;
use Block\Core\Grid as CoreGrid;

class Grid extends CoreGrid
{

    protected $products = null;

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./admin/product/grid.php');
        $this->prepareColumns();
        $this->prepareActions();
        $this->prepareButtons();
    }

    public function prepareColumns()
    {
        $this->addColumn(
            'sku',
            [
                'field' => 'sku',
                'label' => 'SKU',
                'type' => 'text'
            ]
        );
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
                'label' => 'Product Name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'price',
            [
                'field' => 'price',
                'label' => 'Price',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'discount',
            [
                'field' => 'discount',
                'label' => 'Discount',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'quantity',
            [
                'field' => 'quantity',
                'label' => 'Quantity',
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
        $this->addColumn(
            'createdDate',
            [
                'field' => 'createdDate',
                'label' => 'Created Date',
                'type' => 'text'
            ]
        );
    }

    public function setProducts($products = null)
    {
        if (!$products) {
            $products = Mage::getModel("Model\Product");
            $products = $products->fetchAll();
        }
        $this->products = $products;
        return $this;
    }

    public function getProducts()
    {
        if (!$this->products) {
            $this->setProducts();
        }
        return $this->products;
    }

    public function getTitle()
    {
        return "Manage Products";
    }

    public function getPaginationProducts()
    {
        $products = Mage::getModel("Model\Product");
        $recordPerPage = $this->getPager()->getRecordPerPage();
        $start = ($this->getRequest()->getGet('page') * $recordPerPage) - $recordPerPage;
        if ($start < 0) {
            $start = 0;
        }

        $query = "SELECT * from `product`";

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

        return $products->fetchAll($query);
    }

    public function pagination()
    {
        $query = "Select * from `product`";
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

        $product = Mage::getModel('Model\Product');

        $records = $product->getAdapter()->fetchOne($query);

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
                'label' => 'Add Admin',
                'method' => 'getAddNewUrl',
                'icon' => 'fa fa-plus'
            ]
        );
    }

    public function getEditUrl($row)
    {
        return $this->getUrl()->getUrl('form', null, ['id' => $row->productId]);
    }

    public function getDeleteUrl($row)
    {
        return $this->getUrl()->getUrl('delete', null, ['id' => $row->productId]);
    }
}
