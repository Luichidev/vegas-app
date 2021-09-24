<?php 
include_once("Model.php");

class Login  extends Model{
  
  static function login_check(){
    parent::connect();
    $Vista = new Vistas();
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      $email = "";
      $password = "";
      if(isset($_POST["email"])){
        $email = parent::sanitize($_POST["email"]);
        $_SESSION["correo"] = $email;
      }

      if(isset($_POST["password"]))
        $password = $_POST["password"];
      
      if(!empty($email) AND !empty($password)){
        $user = parent::$db->getOne("use_email", parent::sanitize($email), "users", ['use_pass', 'userid', 'use_roll']);
        if(!empty($user)){
          $_SESSION["error_msg"] = "";

          if(password_verify($password, $user[0]["use_pass"])){
            $_SESSION["email"] = $email;
            $_SESSION["userid"] = $user[0]["userid"];
            $_SESSION["userroll"] = $user[0]["use_roll"];
            header("Location: {$_SERVER["PHP_SELF"]}?page=home");
            exit;
          } else {
            $_SESSION["error_msg"] = "<p class=\"alert-error\">*Usuario no autorizado ⛔";
          }

        } else {
          $_SESSION["error_msg"] = "<p class=\"alert-error\">*No existe este usuario ⛔";
        }
      } 
    }

    if(isset($_GET["back"]))
      $_SESSION["error_msg"] = "";
      
    parent::close_connection();
    $Vista->login();
  }

  static function close_session(){
    unset($_SESSION);
    session_destroy();
  }
}