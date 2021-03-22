<?php

namespace Model\Core;

use Mage;

class Table
{

    protected $adapter = null;
    protected $tableName = null;
    protected $primaryKey = null;
    protected $data = [];

    public function __construct()
    {
        $this->setTableName($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    public function resetArray()
    {
        $this->data = [];
        return $this;
    }

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function setAdapter()
    {
        $this->adapter = Mage::getModel("Model\Core\Adapter");
        return $this;
    }

    public function getAdapter()
    {
        if (!$this->adapter) {
            $this->setAdapter();
        }
        return $this->adapter;
    }

    public function setData(array $data)
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
        return $this;
    }

    public function __get($name)
    {
        if (!array_key_exists($name, $this->data)) {
            return null;
        }
        return $this->data[$name];
    }
    public function save()
    {
        if (!array_key_exists($this->getPrimaryKey(), $this->data)) {
            $key = implode(',', array_keys($this->data));

            $values  = array_map(function ($string) {
                return "'" . $string . "'";
            }, array_values($this->data));

            $actual_value = implode(",", $values);
            $query = "insert into `{$this->getTableName()}`({$key}) VALUES ({$actual_value})";

            return $this->insert($query);
        } else {
            $value = array_values($this->data);
            $filed = array_keys($this->data);
            $final = null;

            for ($i = 0; $i < count($filed); $i++) {
                if ($filed[$i] == $this->getPrimaryKey()) {
                    $id = $value[$i];
                    continue;
                }
                $final = $final . "`" . $filed[$i] . "`='" . $value[$i] . "',";
            }
            $final = rtrim($final, ",");

            $query = "UPDATE `{$this->getTableName()}` SET {$final} WHERE `{$this->getPrimaryKey()}` = '{$id}'";

            return $this->update($query);
        }
    }

    public function fetchAll($query = null)
    {
        if (!$query) {
            $query = "SELECT * FROM `{$this->getTableName()}`";
        }
        $rows = $this->getAdapter()->fetchAll($query);
        if (!$rows) {
            return false;
        }
        foreach ($rows as $key => $value) {
            $key = new $this;
            $key->setData($value);
            $rowArray[] = $key;
        }

        $collectionClassName = get_class($this) . '\Collection';
        $collection = Mage::getModel($collectionClassName);
        $collection->setData($rowArray);
        unset($rowArray);
        return $collection;
    }


    public function changeStatus()
    {
        $id = $this->data['id'];
        $st = $this->data['status'];
        if ($st) {
            $status = 0;
        } else {
            $status = 1;
        }
        $query = "UPDATE {$this->getTableName()} SET status={$status} where {$this->getPrimaryKey()}={$id}";

        if (!$this->update($query)) {
            return false;
        }
        return true;
    }

    public function load($value)
    {

        $value = (int)$value;

        $query = "select * from `{$this->getTableName()}` where `{$this->getPrimaryKey()}` = {$value}";

        $row = $this->getAdapter()->fetchRow($query);
        if (!$row) {
            return false;
        }
        $this->data = $row;
        return $this;
    }

    public function insert($query)
    {
        $row = $this->getAdapter()->insert($query);


        if (!$row) {
            return false;
        }

        return $this;
    }

    public function update($query)
    {
        $row = $this->getAdapter()->update($query);
        if (!$row) {
            return false;
        }
        return $this;
    }

    public function delete($query = null)
    {
        if (!$query) {

            $id = $this->data['id'];
            $query = "delete from {$this->getTableName()} where {$this->getPrimaryKey()} = {$id}";
        }
        $row = $this->getAdapter()->delete($query);
        if (!$row) {
            return false;
        }
        return $this;
    }

    public function alterTable($query)
    {
        if (!$query) {
            return false;
        }

        $row = $this->getAdapter()->alterTable($query);
        if (!$row) {
            return false;
        }
        return $this;
    }
}
