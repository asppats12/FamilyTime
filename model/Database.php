<?php
/**
 * Created by PhpStorm.
 * User: Akshay
 * Date: 2017-12-06
 * Time: 8:59 PM
 */

class Database
{
    private static $conn = null;
    private static $dsn = "mysql:host=localhost;dbname=familytime";
    private static $user = "root";
    private static $pass = "";

    private function __construct()
    {
    }

    public static function getConnection(){
        if(self::$conn == null){
            try {
                self::$conn = new PDO(self::$dsn, self::$user, self::$pass);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $ex){
                echo $ex->getMessage();
                exit();
            }
            return self::$conn;
        }
        return false;
    }
}