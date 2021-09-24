<?php 
class Autoload {
  static function includes_all(){
    include_once("libraries/functions.php");
    include_once("model/Login.php");  
    include_once("model/User.php");  
    include_once("model/Roulette.php");  
    include_once("model/Register.php");  
    include_once("model/Admin.php");  
    include_once("views/Vistas.php");  
  }
}