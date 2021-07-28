<?php


namespace core\base\models;
use core\DB;

class BaseModel {

    private $sql = '';
    protected function connection(){
        return DB::getInstance();

    }
    protected function select(){
        $this->sql .= "SELECT * FROM $this->table";
        return $this;
    }
    protected function where($param, $operator, $value){
        $this->sql .= " WHERE $param $operator $value";
        return $this;
    }
    protected function whereAnd($param, $operator, $value){
        $this->sql .= " AND $param $operator $value";
        return $this;
    }
    protected function whereOr($param, $operator, $value){
        $this->sql .= " OR $param $operator $value";
        return $this;
    }
    protected function query($type){
       return $this->connection()->query($this->sql)->fetch($type);
    }
    protected function queryAll($type){
        return $this->connection()->query($this->sql)->fetchAll($type);
    }
}