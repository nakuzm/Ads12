<?php

  require('read_data.php');
  $fileNameServer = 'server_data.txt';
  
  $serverConnect = ( file_exists($fileNameServer) ) ? readData($fileNameServer) : false;
  if(!$serverConnect) {
      exit('Невозможно подключиться к базе данных, введите данные для подключения: '
              . '<a href="install.php">Перейти на страницу подключения</a></br>');
  }
  
  require_once __DIR__."/dbsimple/config.php";
  require_once "DbSimple/Generic.php";
  
  $db = (new DbSimple_Generic)->connect('mysqli://'.$serverConnect['user_name'].':'.$serverConnect['password'].'@'.$serverConnect['server_name'].'/'.$serverConnect['database']);

?>