<?php 
class Vistas {
  private function head($title){
    return "<!DOCTYPE html>".PHP_EOL.
            "<html lang=\"es-ES\">".PHP_EOL.
            "<head>".PHP_EOL.
              "<meta charset=\"UTF-8\">".PHP_EOL.
              "<meta name=\"viewport\" content=\"width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0\">".PHP_EOL.
              "<title>Casino | {$title}</title>".PHP_EOL.
              "<link rel=\"shortcut icon\" href=\"favicon.png\" type=\"image/x-icon\">".PHP_EOL.
              "<link rel=\"stylesheet\" href=\"css/main.css\">".PHP_EOL.
              "<link rel=\"stylesheet\" href=\"css/{$title}.css\">".PHP_EOL.
              // "<script src=\"js/main.js\" defer></script>".PHP_EOL.
              "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js\"></script>".PHP_EOL.
              "<script src=\"js/keyframe.js\" defer></script>".PHP_EOL.
              "<script type=\"module\" src=\"js/roulette.js\" defer></script>".PHP_EOL.
            "</head>";
    
  }

  private function menu (){
    $res = "<ul id=\"menu\" class=\"flex-container\">".PHP_EOL.
              "<li>".PHP_EOL.
                "<ul id=\"games\" class=\"flex-container\">".PHP_EOL;
    
                  switch ($_GET["page"]) {
                    case 'home':
                      $res .= "<li><a class=\"active\" href=\"" . $_SERVER["PHP_SELF"] . "?page=home" . "\">Salon</a></li>".PHP_EOL;
                      $res .= "<li><a href=\"". $_SERVER["PHP_SELF"] . "?page=roulette" . "\">Roulette</a></li>".PHP_EOL;
                      $res .= "<li><a href=\"". $_SERVER["PHP_SELF"] . "?page=blackjack" . "\">Black Jack</a></li>".PHP_EOL;
                      break;
                    case 'roulette':
                      $res .= "<li><a href=\"" . $_SERVER["PHP_SELF"] . "?page=home" . "\">Salon</a></li>".PHP_EOL;
                      $res .= "<li><a class=\"active\" href=\"". $_SERVER["PHP_SELF"] . "?page=roulette" . "\">Roulette</a></li>".PHP_EOL;
                      $res .= "<li><a href=\"". $_SERVER["PHP_SELF"] . "?page=blackjack" . "\">Black Jack</a></li>".PHP_EOL;
                      break;
                    case 'blackjack':
                      $res .= "<li><a href=\"" . $_SERVER["PHP_SELF"] . "?page=home" . "\">Salon</a></li>".PHP_EOL;
                      $res .= "<li><a href=\"". $_SERVER["PHP_SELF"] . "?page=roulette" . "\">Roulette</a></li>".PHP_EOL;
                      $res .= "<li><a class=\"active\" href=\"". $_SERVER["PHP_SELF"] . "?page=blackjack" . "\">Black Jack</a></li>".PHP_EOL;
                      break;
                    default:
                      $res .= "<li><a href=\"" . $_SERVER["PHP_SELF"] . "?page=home" . "\">Salon</a></li>".PHP_EOL;
                      $res .= "<li><a href=\"". $_SERVER["PHP_SELF"] . "?page=roulette" . "\">Roulette</a></li>".PHP_EOL;
                      $res .= "<li><a href=\"". $_SERVER["PHP_SELF"] . "?page=blackjack" . "\">Black Jack</a></li>".PHP_EOL;
                    break;
                  }

    $res .=     "</ul>".PHP_EOL.
              "</li>".PHP_EOL.
              "<li>".PHP_EOL.
                "<ul id=\"info\" class=\"flex-container\">".PHP_EOL.
                  ($_SESSION["userroll"] === "10" 
                  ? "<li><a href=\"" . $_SERVER["PHP_SELF"] . "?page=admin" . "\"><span class=\"menu-admin\">Control<span></a></li>"
                  : "") . PHP_EOL.
                  "<li class=\"text\">" . $_SESSION["usernick"] . "</li>".PHP_EOL.
                  "<li class=\"text\">Saldo: " . $_SESSION["userbalance"] . " €</li>".PHP_EOL.
                  "<li><a href=\"" . $_SERVER["PHP_SELF"] . "?page=close" . "\">Logout</a></li>".PHP_EOL.
                "</ul>".PHP_EOL.
              "</li>".PHP_EOL.
            "</ul>";
    return $res;
  }

  private function footer() {
    return "<footer>".PHP_EOL.
              "<h3>Casino Online</h3>".PHP_EOL.
            "</footer>".PHP_EOL.
          "</html>";
  }

  function home() {
    $res = $this->head("home");
    $res .= "<body>".PHP_EOL.
              "<section class=\"home\">".PHP_EOL.
                "<nav>".PHP_EOL.
                  $this->menu() . 
                "</nav>".PHP_EOL.
              "</section>".PHP_EOL.
            "</body>";
    $res .= $this->footer();
    echo $res;
  }

  function login(){
    $res = $this->head("login");
    $res .= "<body>".PHP_EOL.
              "<section class=\"flex-container login\">".PHP_EOL.
                "<div class=\"form-container\">".PHP_EOL.
                  "<form action=" . $_SERVER["PHP_SELF"] . " method=\"POST\" autocomplete=\"off\">".PHP_EOL.
                    "<div class=\"form-group\">".PHP_EOL.
                      "<input type=\"text\" placeholder=\"ejemplo@ejemplo.com\" name=\"email\" value=\"" . (!empty($_SESSION["correo"]) ? $_SESSION["correo"] . "\">" : "\">") . "</div>".PHP_EOL.
                    "<div class=\"form-group\">".PHP_EOL.
                      "<input type=\"password\" name=\"password\" placeholder=\"password\">".PHP_EOL.
                    "</div>".PHP_EOL.
                    "<div class=\"btn-group\">".PHP_EOL.
                      "<button class=\"btn success\" name=\"login\">Entrar</button>".PHP_EOL.
                      "<a href=\"" . $_SERVER["PHP_SELF"] . "?page=register" . "\" class=\"btn success\">Registrarse</a>".PHP_EOL.
                    "</div>" . (!empty($_SESSION["error_msg"])? $_SESSION["error_msg"] : "") . "</form>".PHP_EOL.
                "</div>".PHP_EOL.
              "</section>".PHP_EOL.
              "<section class=\"flex-container movile-login\" hidden>".PHP_EOL.
                "<div>
                  <img src=\"images/casino-logo.png\">
                  <h3>Actualmente el casino solo está disponible para PC.</h3>
                </div>". PHP_EOL.
              "</section>".PHP_EOL.

            "</body>";
    $res .= $this->footer();
    echo $res;
  }

  function roulette() {
    $res = $this->head("roulette");
    $res .= "<body>".PHP_EOL.
              "<section class=\"roulette\">".PHP_EOL.
                "<nav>".PHP_EOL.
                  $this->menu() . 
                "</nav>".PHP_EOL.
                "<div class=\"roulette-container\">".PHP_EOL.
                  "<div class=\"tapete flex-container\">".PHP_EOL.
                    "<div class=\"flex-1\">".PHP_EOL.
                      // "<canvas id=\"canvas\" width=\"500\" height=\"500\"></canvas>".PHP_EOL.
                      $this->roulette_js() .
                    "</div>".PHP_EOL.
                    "<div class=\"flex-1 img\">".PHP_EOL.
                      "<img src=\"images/roulette-tapete.png\" alt=\"tapete de la ruleta\">".PHP_EOL.
                    "</div>".PHP_EOL.
                  "</div>".PHP_EOL.
                  "<div class=\"msg\"></div>".PHP_EOL.
                  "<form action=\"" . $_SERVER["PHP_SELF"] . "?page=roulette" . "\" method=\"POST\">".PHP_EOL.
                  "<button class=\"btn success\" id=\"spin\">Jugar</button>".PHP_EOL.
                  "<select class=\"btn\" name=\"jugada\" id=\"jugada\">".PHP_EOL.
                    "<option value=\"1\">Pares</option>".PHP_EOL.
                    "<option value=\"2\">Impares</option>".PHP_EOL.
                    "<option value=\"3\">Rojo</option>".PHP_EOL.
                    "<option value=\"4\">Negro</option>".PHP_EOL.
                  "</select>".PHP_EOL.
                  "<select class=\"btn\" name=\"apuesta\" id=\"apuesta\">".PHP_EOL.
                    "<option value=\"5\">5 €</option>".PHP_EOL.
                    "<option value=\"10\">10 €</option>".PHP_EOL.
                    "<option value=\"20\">20 €</option>".PHP_EOL.
                    "<option value=\"50\">50 €</option>".PHP_EOL.
                    "<option value=\"100\">100 €</option>".PHP_EOL.
                  "</select>".PHP_EOL.
                  "</form>".PHP_EOL.
                "</div>".PHP_EOL.
              "</section>".PHP_EOL.
            "</body>";

    $res .= $this->footer();
    echo $res;
  }
  
  function roulette_withData($sorteo, $msg, $color_jugada, $apuesta, $jugada, $no_saldo) {
    $res = $this->head("roulette");
    $res .= "<body>".PHP_EOL.
              "<script type=\"module\">".PHP_EOL.
                "import spinTo from './js/roulette.js';". PHP_EOL .
                  "spinTo(".$sorteo.")". PHP_EOL .
                  "sorteo.style.color = '#a7342f' ". PHP_EOL .
                  "msg.style.color = '#a7342f' ". PHP_EOL .
              "</script>".PHP_EOL.
              "<section class=\"roulette\">".PHP_EOL.
                "<nav>".PHP_EOL.
                  $this->menu() . 
                "</nav>".PHP_EOL.
                "<div class=\"roulette-container\">".PHP_EOL.
                  "<div class=\"tapete flex-container\">".PHP_EOL.
                    "<div class=\"flex-1\">".PHP_EOL.
                      // "<canvas id=\"canvas\" width=\"500\" height=\"500\"></canvas>".PHP_EOL.
                      $this->roulette_js() .
                    "</div>".PHP_EOL.
                    "<div class=\"flex-1 img\">".PHP_EOL.
                      "<img src=\"images/roulette-tapete.png\" alt=\"tapete de la ruleta\">".PHP_EOL.
                    "</div>".PHP_EOL.
                  "</div>".PHP_EOL.
                  "<div class=\"msg\">
                    <h3 id=\"sorteo\">{$sorteo}</h3>
                    <p id=\"msg\">{$msg['msg']}</p>".
                    ($msg["winner"] 
                      ? "<script>  winner = true;</script>"
                      : "<script>  winner = false;</script>") .
                  "</div>".PHP_EOL.
                  "<form action=\"" . $_SERVER["PHP_SELF"] . "?page=roulette" . "\" method=\"POST\">".PHP_EOL.
                  "<button class=\"btn success\" id=\"spin\"" . ($no_saldo ? "disabled": "") . ">Jugar</button>".PHP_EOL.
                  "<select class=\"btn\" name=\"jugada\" id=\"jugada\">".PHP_EOL.
                    "<option value=\"1\"". ($jugada === "1" ? "selected" : "") .">Pares</option>".PHP_EOL.
                    "<option value=\"2\"". ($jugada === "2" ? "selected" : "") .">Impares</option>".PHP_EOL.
                    "<option value=\"3\"". ($jugada === "3" ? "selected" : "") .">Rojo</option>".PHP_EOL.
                    "<option value=\"4\"". ($jugada === "4" ? "selected" : "") .">Negro</option>".PHP_EOL.
                  "</select>".PHP_EOL.
                  "<select class=\"btn\" name=\"apuesta\" id=\"apuesta\">".PHP_EOL.
                    "<option value=\"5\"" . ($apuesta === "5" ? "selected" : "") . ">5 €</option>".PHP_EOL.
                    "<option value=\"10\"" . ($apuesta === "10" ? "selected" : "") .">10 €</option>".PHP_EOL.
                    "<option value=\"20\"" . ($apuesta === "20" ? "selected" : "") . ">20 €</option>".PHP_EOL.
                    "<option value=\"50\"" . ($apuesta === "50" ? "selected" : "") .">50 €</option>".PHP_EOL.
                    "<option value=\"100\"" . ($apuesta === "100" ? "selected" : "") .">100 €</option>".PHP_EOL.
                  "</select>".PHP_EOL.
                  "</form>".PHP_EOL.
                "</div>".PHP_EOL.
              "</section>".PHP_EOL.
            "</body>";

    $res .= $this->footer();
    echo $res;
  }

  function blackjack() {
    $res = $this->head("blackjack");
    $res .= "<body>".PHP_EOL.
              "<section class=\"blackjack\">".PHP_EOL.
                "<nav>".PHP_EOL.
                  $this->menu() . 
                "</nav>".PHP_EOL.
                "<div class=\"construccion\">".PHP_EOL.
                  "<img src=\"images/casino-construccion.jpg\" alt=\"Página en construcción\">".PHP_EOL.
                "</div>".PHP_EOL.
              "</section>".PHP_EOL.
            "</body>";
    $res .= $this->footer();
    echo $res;
  }

  function register() {
    $res = $this->head("register");
    $res .= "<body>".PHP_EOL.
              "<section class=\"flex-container register\">".PHP_EOL.
                "<a class=\"btn success back\" href=\"{$_SERVER["PHP_SELF"]}?back\">volver</a>".PHP_EOL.
                "<div class=\"form-container\">".PHP_EOL.
                  "<form action=" . $_SERVER["PHP_SELF"] . "?page=register" . " method=\"POST\" autocomplete=\"off\">".PHP_EOL.
                    "<div class=\"form-group\">".PHP_EOL.
                      "<input type=\"text\" placeholder=\"Código de invitación\" name=\"invite\" value=\"" . (!empty($_SESSION["invite"]) ? $_SESSION["invite"] . "\">" : "\">") . PHP_EOL.
                    "</div>".PHP_EOL.
                    "<div class=\"form-group\">".PHP_EOL.
                      "<input type=\"text\" placeholder=\"nick\" name=\"nick\" value=\"" . (!empty($_SESSION["usernick"]) ? $_SESSION["usernick"] . "\">" : "\">") . PHP_EOL.
                    "</div>".PHP_EOL.
                    "<div class=\"form-group\">".PHP_EOL.
                      "<input type=\"text\" placeholder=\"ejemplo@ejemplo.com\" name=\"email\" value=\"" . (!empty($_SESSION["correo"]) ? $_SESSION["correo"] . "\">" : "\">") . PHP_EOL.
                    "</div>".PHP_EOL.
                    "<div class=\"form-group\">".PHP_EOL.
                      "<input type=\"password\" name=\"password\" placeholder=\"password\">".PHP_EOL.
                    "</div>".PHP_EOL.
                    "<div class=\"btn-group\">".PHP_EOL.
                      "<button class=\"btn success\" name=\"register\">Enviar</button>".PHP_EOL.
                    "</div>". 
                      (!empty($_SESSION["error_msg"])? $_SESSION["error_msg"] : "") . 
                      (!empty($_SESSION["msg"])? $_SESSION["msg"] : "") . 
                  "</form>".PHP_EOL.
                "</div>".PHP_EOL.
              "</section>".PHP_EOL.
            "</body>";
    $res .= $this->footer();
    echo $res;
  }

  private function roulette_js(){
    return "<div class=\"spinner\">".PHP_EOL.
              "<div class=\"ball\"><span></span></div>".PHP_EOL.
              "<div class=\"platebg\"></div>".PHP_EOL.
              "<div class=\"platetop\"></div>".PHP_EOL.
              "<div id=\"toppart\" class=\"topnodebox\">".PHP_EOL.
                "<div class=\"silvernode\"></div>".PHP_EOL.
                "<div class=\"topnode silverbg\"></div>".PHP_EOL.
                "<span class=\"top silverbg\"></span>".PHP_EOL.
                "<span class=\"right silverbg\"></span>".PHP_EOL.
                "<span class=\"down silverbg\"></span>".PHP_EOL.
                "<span class=\"left silverbg\"></span>".PHP_EOL.
              "</div>".PHP_EOL.
              "<div id=\"rcircle\" class=\"pieContainer\">".PHP_EOL.
                "<div class=\"pieBackground\"></div>".PHP_EOL.
                "<div class=\"hold\" id=\"rSlice0\" style=\"transform: rotate(0deg);\">
                  <div class=\"num\">0</div>
                  <div class=\"pie greenbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice1\" style=\"transform: rotate(9.72973deg);\">
                  <div class=\"num\">32</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice2\" style=\"transform: rotate(19.4595deg);\">
                  <div class=\"num\">15</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice3\" style=\"transform: rotate(29.1892deg);\">
                  <div class=\"num\">19</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice4\" style=\"transform: rotate(38.9189deg);\">
                  <div class=\"num\">4</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice5\" style=\"transform: rotate(48.6486deg);\">
                  <div class=\"num\">21</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice6\" style=\"transform: rotate(58.3784deg);\">
                  <div class=\"num\">2</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice7\" style=\"transform: rotate(68.1081deg);\">
                  <div class=\"num\">25</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice8\" style=\"transform: rotate(77.8378deg);\">
                  <div class=\"num\">17</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice9\" style=\"transform: rotate(87.5676deg);\">
                  <div class=\"num\">34</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice10\" style=\"transform: rotate(97.2973deg);\">
                  <div class=\"num\">6</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice11\" style=\"transform: rotate(107.027deg);\">
                  <div class=\"num\">27</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice12\" style=\"transform: rotate(116.757deg);\">
                  <div class=\"num\">13</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice13\" style=\"transform: rotate(126.486deg);\">
                  <div class=\"num\">36</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice14\" style=\"transform: rotate(136.216deg);\">
                  <div class=\"num\">11</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice15\" style=\"transform: rotate(145.946deg);\">
                  <div class=\"num\">30</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice16\" style=\"transform: rotate(155.676deg);\">
                  <div class=\"num\">8</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice17\" style=\"transform: rotate(165.405deg);\">
                  <div class=\"num\">23</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice18\" style=\"transform: rotate(175.135deg);\">
                  <div class=\"num\">10</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice19\" style=\"transform: rotate(184.865deg);\">
                  <div class=\"num\">5</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice20\" style=\"transform: rotate(194.595deg);\">
                  <div class=\"num\">24</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice21\" style=\"transform: rotate(204.324deg);\">
                  <div class=\"num\">16</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice22\" style=\"transform: rotate(214.054deg);\">
                  <div class=\"num\">33</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice23\" style=\"transform: rotate(223.784deg);\">
                  <div class=\"num\">1</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice24\" style=\"transform: rotate(233.514deg);\">
                  <div class=\"num\">20</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice25\" style=\"transform: rotate(243.243deg);\">
                  <div class=\"num\">14</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice26\" style=\"transform: rotate(252.973deg);\">
                  <div class=\"num\">31</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice27\" style=\"transform: rotate(262.703deg);\">
                  <div class=\"num\">9</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice28\" style=\"transform: rotate(272.432deg);\">
                  <div class=\"num\">22</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice29\" style=\"transform: rotate(282.162deg);\">
                  <div class=\"num\">18</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice30\" style=\"transform: rotate(291.892deg);\">
                  <div class=\"num\">29</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice31\" style=\"transform: rotate(301.622deg);\">
                  <div class=\"num\">7</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice32\" style=\"transform: rotate(311.351deg);\">
                  <div class=\"num\">28</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice33\" style=\"transform: rotate(321.081deg);\">
                  <div class=\"num\">12</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice34\" style=\"transform: rotate(330.811deg);\">
                  <div class=\"num\">35</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice35\" style=\"transform: rotate(340.541deg);\">
                  <div class=\"num\">3</div>
                  <div class=\"pie redbg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>
                <div class=\"hold\" id=\"rSlice36\" style=\"transform: rotate(350.27deg);\">
                  <div class=\"num\">26</div>
                  <div class=\"pie greybg\" style=\"transform: rotate(9.73deg);\"></div>
                </div>".PHP_EOL.
              "</div>".PHP_EOL.
            "</div>";
  }

  function admin($data) {
    $res = $this->head("admin");
    $res .= "<body>".PHP_EOL.
              "<section class=\"admin\">".PHP_EOL.
                "<nav>".PHP_EOL.
                  $this->menu() . 
                "</nav>".PHP_EOL.
                "<div class=\"admin-container\">
                  <h2> Usuarios </h2>
                  <form action=\"" . $_SERVER["PHP_SELF"] . "?page=admin" . "\" method=\"POST\">".PHP_EOL.
                    "<input type=\"text\" name=\"nick\" placeholder=\"nick\" required>".PHP_EOL.
                    "<input type=\"text\" name=\"saldo\" placeholder=\"saldo\">".PHP_EOL.
                    "<button class=\"btn success\" name=\"sendUser\">Enviar</button>".PHP_EOL.
                  "</form>".PHP_EOL.
                  "<table class=\"table-user\">".PHP_EOL.
                    "<thead>".PHP_EOL.
                      "<tr>".PHP_EOL.
                        "<th>Nro</th>".PHP_EOL.
                        "<th>Id</th>".PHP_EOL.
                        "<th>Nick</th>".PHP_EOL.
                        "<th>Saldo</th>".PHP_EOL.
                        "<th>Roll</th>".PHP_EOL.
                        "<th>Acciones</th>".PHP_EOL.
                      "</tr>".PHP_EOL.
                    "</thead>".PHP_EOL.
                    "<tbody>".PHP_EOL.
                      $this->drawRows($data["users"], "users") .
                    "</tbody>".PHP_EOL.
                  "</table>".PHP_EOL.
                "</div>".PHP_EOL.
                "<div class=\"admin-container\">
                  <h2> Códigos de invitaciones </h2>
                  <form action=\"" . $_SERVER["PHP_SELF"] . "?page=admin" . "\" method=\"POST\">".PHP_EOL.
                    "<input type=\"text\" name=\"title\" placeholder=\"title\" required>".PHP_EOL.
                    "<input type=\"text\" name=\"saldo\" placeholder=\"saldo\">".PHP_EOL.
                    "<input type=\"text\" name=\"roll\" placeholder=\"roll\">".PHP_EOL.
                    "<button class=\"btn success\" name=\"sendInv\">Enviar</button>".PHP_EOL.
                  "</form>".PHP_EOL.
                  "<table class=\"table-user\">".PHP_EOL.
                    "<thead>".PHP_EOL.
                      "<tr>".PHP_EOL.
                        "<th>Nro</th>".PHP_EOL.
                        "<th>Id</th>".PHP_EOL.
                        "<th>Title</th>".PHP_EOL.
                        "<th>Saldo</th>".PHP_EOL.
                        "<th>Roll</th>".PHP_EOL.
                        "<th>Acciones</th>".PHP_EOL.
                      "</tr>".PHP_EOL.
                    "</thead>".PHP_EOL.
                    "<tbody>".PHP_EOL.
                      $this->drawRows($data["invitations"], "invitations") .
                    "</tbody>".PHP_EOL.
                  "</table>".PHP_EOL.
                "</div>".PHP_EOL.
              "</section>".PHP_EOL.
            "</body>";
    $res .= $this->footer();
    echo $res;
  }

  function drawRows($data, $mode=""){
    $res = "";
    $count = 1;
    if(!empty($data)){
      foreach ($data as $user) {
        $res .= "<tr>";
        $res .= "<td>{$count}</td>";
        foreach ($user as $key => $value) {
          $roll = 1;
          $res .= "<td>{$value}</td>";
          if($key === "use_roll" AND $value === "10") $roll = $value;
        }

        if($mode) {
          if($mode === "users")
            $res .= ($roll !== "10" ? "<td><a href=\"{$_SERVER["PHP_SELF"]}?page=admin&delUser={$user["userid"]}\">🗑️</a></td>" : "<td title=\"admin\">💻</td>");
          elseif($mode === "invitations")
            $res .= "<td><a href=\"{$_SERVER["PHP_SELF"]}?page=admin&delInv={$user["invitationid"]}\">🗑️</a></td>";
        }
        $res .= "</tr>";
        $count++;
      } 
    }else {
      $res .= "<tr><td colspan=\"6\">No hay datos</td></tr>";
    }
    
    return $res;
  }
}