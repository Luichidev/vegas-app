<?php 

class Register extends Model {
  static function add_user(){
    $Vista = new Vistas();
    parent::connect();
    
    if($_SERVER["REQUEST_METHOD"] === "POST"){
      if(isset($_POST["register"])){
        $codigo = "";
        $nick = "";
        $email = "";
        $pass = "";
        $error = false;
        $_SESSION["msg"] = "";
        $_SESSION["error_msg"] = "";

        if(isset($_POST["invite"])){
          $codigo = parent::sanitize($_POST["invite"]);
          $_SESSION["codigo"] = $codigo;
        } 
        
        if(!empty($codigo)){
          $_SESSION["error_msg"] = "";
          $invitacion = parent::$db->getOne("inv_title", $codigo, "invitations", []);
          if(is_array($invitacion)){
            if(empty($_POST["nick"]))
              $error = true;
              
            if(empty($_POST["email"]))
              $error = true;
            elseif(!parent::is_email($_POST["email"]))
              $error = true;

            if(empty($_POST["password"]))
              $error = true;

            if(!$error){
              $data["use_nick"] = strtolower(parent::sanitize($_POST["nick"]));
              $data["use_pass"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
              $data["use_email"] = strtolower(parent::sanitize($_POST["email"]));
              $data["use_balance"] = parent::sanitize($invitacion[0]["inv_balance"]);
              $data["use_roll"] = 1; //ponemos simpre roll 1 = usuario normal
              $res = parent::$db->insert("users", $data);
              $_SESSION["msg"] = "<p class=\"alert-success\">✔️Usuario creado correctamente.";
            } else {
              $_SESSION["error_msg"] = "<p class=\"alert-error\">*Todos los campos son obligatorios o el email es invalido ⛔"; 
            }  
          } else {
            $_SESSION["error_msg"] = "<p class=\"alert-error\">*Código incorrecto ⛔";  
          }
        } else {
          $_SESSION["error_msg"] = "<p class=\"alert-error\">*Necesitas un código de invitación ⛔";
        }
      }
    }
    parent::close_connection();
    $Vista->register();
  }
}