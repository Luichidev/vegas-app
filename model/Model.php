<?php 
include_once("libraries/mysqluis.php");
include_once("views/Vistas.php");

class Model {
  protected static $db; 

  static function connect(){
    include_once("config.php");
    self::$db = new mysqluis(DBHOST, DBUSER, DBPASS, DBNAME);
  }  

  static function sanitize($string){
    $res = strip_tags(htmlspecialchars($string));
    return $res;
  }

  static function is_email($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  static function close_connection(){
    self::$db->close();
  }
}