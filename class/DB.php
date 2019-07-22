<?php
require_once("db_config.php");

abstract class DB {

    private static $instance;

    public static function getInstance() {

        if (!isset(self::$instance)) {

            try {
                
                self::$instance = new PDO(DB_DRIVER.':host='.DB_HOST.';dbname='.DB_NOME, DB_USUARIO, DB_SENHA);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }

    public static function prepare($sql) {

        return self::getInstance()->prepare($sql);
    }

}
