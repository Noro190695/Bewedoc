<?php
namespace core;
use PDO;


class DB {
    private static $instance = null;
    private static $dns = DB_INFO['driver'].':dbname='.DB_INFO['db_name'].';host='.DB_INFO['host'];
    private static $user = DB_INFO['user'];
    private static $pass = DB_INFO['password'];


    public static function getInstance()  {

        if (self::$instance === null){
            try {
                self::$instance = new PDO(self::$dns, self::$user, self::$pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

                self::$instance->query('SET NAMES utf8');
                self::$instance->query('SET CHARACTER SET utf8');

            } catch(PDOException $error) {
                echo $error->getMessage();
            }
        }
        return self::$instance;
    }
    private function __construct(){}
    private function __clone(){}

}