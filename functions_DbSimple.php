<?php

  function databaseErrorHandler($message, $info) {
    // Если использовалась @, ничего не делать.
    if ( !error_reporting() ) return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>"; 
    print_r($info);
    echo "</pre>";
    exit();
  }
  
  function myLogger($db, $sql, $caller) {
    global $firePHP;
    if(isset($caller['file'])) {
      $firePHP ->group("at ".@$caller['file'].' line '.@$caller['line']);            
    }
    $firePHP ->log($sql);
    if(isset($caller['file'])) {
      $firePHP ->groupEnd();
    }
  }
  
?>
