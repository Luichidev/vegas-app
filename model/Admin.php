<?php 
  class Admin  extends Model{
    static function control() {
      parent::connect();
      $Vista = new Vistas();
      $data = self::get_user_invitations();
      
      
      if($_SERVER["REQUEST_METHOD"] === "POST"){
        $nick = "";
        $saldo = 0;
        $roll = 1;
        $title = "";

        if(!empty($_POST["saldo"]))
          $saldo = parent::sanitize($_POST["saldo"]);

        if(!empty($_POST["roll"]))
          $roll = parent::sanitize($_POST["roll"]);

        
        if(isset($_POST["sendUser"])){
          if(!empty($_POST["nick"]))
            $nick = parent::sanitize($_POST["nick"]);

          if(!empty($nick) AND $saldo > 0){
              $res = parent::$db->getOne("use_nick", $nick, "users", ["use_email"]);
              if(is_array($res)){
                $email = $res[0]["use_email"];
                parent::$db->update("users", ["use_balance" => "{$saldo}", "use_email" => "{$email}"], "use_email");
                $balance = parent::$db->getOne("use_email", $email, "users", ["use_balance"]);
                $_SESSION["userbalance"] = intval($balance[0]["use_balance"]);
                $data = self::get_user_invitations();
              }
          }

        } elseif(isset($_POST["sendInv"])) {
          if(!empty($_POST["title"]))
            $title = strtoupper(parent::sanitize($_POST["title"]));
          
          if(!empty($title) AND $saldo > 0){
            parent::$db->insert("invitations", ["inv_title" => $title, "inv_balance" => $saldo, "inv_roll" => $roll]);
            $data = self::get_user_invitations();
            
          }
        }
      }

      if($_SERVER["REQUEST_METHOD"] === "GET"){
        $id = "0";
        if(!empty($_GET["delUser"])) {
          $id = parent::sanitize($_GET["delUser"]);
          parent::$db->deleteOne("userid", $id, "users");
        }elseif(!empty($_GET["delInv"])){
          $id = parent::sanitize($_GET["delInv"]);
          parent::$db->deleteOne("invitationid", $id, "invitations");
        }

        $data = self::get_user_invitations();
      }

      parent::close_connection();
      $Vista->admin($data);
    }

    static function get_user_invitations(){
      $data = [];
      $data["users"] = parent::$db->get("users", ["userid", "use_nick", "use_balance", "use_roll"]);
      $data["invitations"] = parent::$db->get("invitations", ["invitationid", "inv_title", "inv_balance", "inv_roll"]);
      return $data;
    }
  } 