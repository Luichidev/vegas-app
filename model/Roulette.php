<?php 
  class Roulette {

    static function jugar(){
      $Vista = new Vistas();
      if(!empty($_POST["jugada"]) AND !empty($_POST["apuesta"])){
        $jugada = htmlspecialchars($_POST["jugada"]);
        $apuesta = htmlspecialchars($_POST["apuesta"]);
        $colors = ["verde", "rojo", "negro", "rojo", "negro", "rojo", "negro", "rojo", "negro", "rojo", "negro", "negro", "rojo", "negro", "rojo", "negro", "rojo", "negro", "rojo", "rojo", "negro", "rojo", "negro", "rojo", "negro", "rojo", "negro", "rojo", "negro", "negro", "rojo", "negro", "rojo", "negro", "rojo", "negro", "rojo"];
        $sorteo = rand(0,36);
        $color_jugada = $colors[$sorteo];
        $no_saldo = true;
        $msg = ["No tienes saldo"];
        $msg = ["winner" => false, "msg" => "No tienes saldo"];
        $res = User::get_balance($_SESSION["email"]);
        $_SESSION["userbalance"] = intval($res[0]["use_balance"]);
        
        if($_SESSION["userbalance"] > 0) {
          $no_saldo = false;
          if($sorteo > 0){
            switch ($jugada) {
              case '1':
                $msg = self::is_par($sorteo) ? self::winner($apuesta) : self::loser($apuesta);
                User::update_balance($_SESSION["email"], $_SESSION["userbalance"]);
                break;
              case '2':
                $msg = !self::is_par($sorteo) ? self::winner($apuesta) : self::loser($apuesta);
                User::update_balance($_SESSION["email"], $_SESSION["userbalance"]);
                break;
              case '3':
                $msg = $color_jugada === "rojo" ? self::winner($apuesta) : self::loser($apuesta);
                User::update_balance($_SESSION["email"], $_SESSION["userbalance"]);
                break;
              case '4':
                $msg = $color_jugada === "negro" ? self::winner($apuesta) : self::loser($apuesta);
                User::update_balance($_SESSION["email"], $_SESSION["userbalance"]);
                break;
            }
          } else {
            $msg = self::loser($apuesta);
          }
        }
        
        $Vista->roulette_withData($sorteo, $msg, $color_jugada, $apuesta, $jugada, $no_saldo);
      } else {
        $Vista->roulette();
      }
    }

    static function winner($apuesta) {
      $_SESSION["userbalance"] = $_SESSION["userbalance"] + intval($apuesta);
      return $msg = ["winner" => true, "msg" => "Ganas {$apuesta} €"];
    }

    static function loser($apuesta) {
      $_SESSION["userbalance"] = $_SESSION["userbalance"] - intval($apuesta);
      return $msg = ["winner" => false, "msg" => "Pierdes {$apuesta} €"];
    }

    static function is_par($number){
      return $number % 2 === 0;
    }
  }