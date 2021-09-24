<?php 

class User extends Model{
  
  static function get_user($userid){
    parent::connect();
    
    $user = parent::$db->getOne("userid", $userid, "users");
    $_SESSION["userroll"] = $user[0]["use_roll"];
    $_SESSION["usernick"] = ucfirst($user[0]["use_nick"]);
    $_SESSION["userbalance"] = $user[0]["use_balance"];

    parent::close_connection();
  }

  static function get_balance($email){
    parent::connect();
    $res = parent::$db->getOne("use_email", $email, "users", ["use_balance"]);
    parent::close_connection();
    return $res;
  }

  static function get_email($nick){
    parent::connect();
    $res = parent::$db->getOne("use_nick", $nick, "users", ["use_email"]);
    parent::close_connection();
    return $res;
  }
  
  static function update_balance($email, $balance){
    parent::connect();
    $res = parent::$db->update("users", ["use_balance" => "{$balance}", "use_email" => "{$email}"], "use_email");
    parent::close_connection();
    return $res;
  }
}