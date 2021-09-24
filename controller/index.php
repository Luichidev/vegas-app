<?php 
  session_start();
  include_once("includes.php");
  Autoload::includes_all();
  $Vista = new Vistas();
  
  if(empty($_SESSION["email"])){
    if(isset($_GET["page"]) AND $_GET["page"] === "register")
      Register::add_user();
    else 
      Login::login_check();
  } else {
    $page = !empty($_GET["page"]) ? $_GET["page"] : "";
    switch ($page) {
      case 'close':
        Login::close_session();
        $Vista->login();
        break;
      case 'home':
        if(empty($_SESSION["usernick"])){
          User::get_user($_SESSION["userid"]);
        }
        $Vista->home();
        break;
      case 'roulette':
        Roulette::Jugar();
        break;
      case 'admin':
        Admin::control();
        break;
      case 'blackjack':
        $Vista->blackjack();
        break;
      default:
        $Vista->home();
        break;
    }
  }

  // dump_var($_GET);
  dump_var($_POST);
  dump_var($_SESSION);