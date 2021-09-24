<?php 
/**
 * Author: @luichidev
 * Web: https://luisalbertoarana.com
 * Creation: 16/06/2021
 * Revision: 16/16/2021
 */

 //PROTOTYPE: Void dump_var(Array $array)
 function dump_var($array) {
   echo "<pre>";
   var_dump($array);
   echo "</pre>";
  }
  
  //PROTOTYPE: String sanitize(String $input)
  function sanitize($input) {
    return strip_tags(htmlspecialchars($input));
  }
 


?>