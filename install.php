<?php    
  header('Content-type: text/html; charset=utf-8');
  error_reporting(E_ALL ^ E_STRICT);
  ini_set('display_errors', 1);

  require_once __DIR__."/dbsimple/config.php";
  require_once "DbSimple/Generic.php";
  
  require_once __DIR__."/firephp/FirePHP.class.php";
  $firePHP = FirePHP::getInstance(true);
  $firePHP -> setEnabled(true);
  
  require_once('functions_DbSimple.php');
  require('write_data.php');

  $link = '';
  
  if (isset($_POST['main_form_submit'])) {
    $db = (new DbSimple_Generic)->connect('mysqli://'.$_POST['user_name'].':'.$_POST['password'].'@'.$_POST['server_name'].'/'.$_POST['database']);
    $db->setErrorHandler('databaseErrorHandler');
    $db->setLogger('myLogger');
    
    writeData($_POST, 'server_data.txt');
    
    $templine = '';
    $lines = file('tables_xaver.sql');
    foreach ($lines as $line) {
        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '') continue;
        $templine .= $line;
        // If it has a semicolon at the end, it's the end of the query
        if (substr(trim($line), -1, 1) == ';') {
            if(!@$db->query($templine)) {
              $link = '<a href="index.php">Перейти на сайт</a>';
            } else {
              $link = 'Ошибка: Данные введены неверно.';
            }
            $templine = '';
        }
    }
  }
  
  $smarty_dir = __DIR__.'/smarty/';
  require_once($smarty_dir.'libs/Smarty.class.php');
  $smarty = new Smarty();
  $smarty->compile_check = true;
  $smarty->debugging = true;
  $smarty->template_dir = $smarty_dir.'templates/';
  $smarty->compile_dir = $smarty_dir.'templates_c/';
  $smarty->config_dir = $smarty_dir.'configs/';
  $smarty->cache_dir = $smarty_dir.'cache/';
  
  $smarty->assign('show_link', $link);

  $smarty->display('login.tpl');
?>