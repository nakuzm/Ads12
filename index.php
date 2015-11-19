<?php    
  header('Content-type: text/html; charset=utf-8');
  error_reporting(E_ALL ^ E_STRICT);
  ini_set('display_errors', 1);
  
  require('connect_to_db.php');
  
  require_once __DIR__."/firephp/FirePHP.class.php";
  $firePHP = FirePHP::getInstance(true);
  $firePHP -> setEnabled(true);
  
  require('HtmlOption.php');
  require('functions_DbSimple.php');
  require('Ad.php');
  require('AdStorage.php');
  require('AdCompany.php');
  require('AdPrivate.php');
  
  $db->setErrorHandler('databaseErrorHandler');
  $db->setLogger('myLogger');
  
  $db->query("SET NAMES utf8");
  
  $smarty_dir = __DIR__.'/smarty/';
  require_once $smarty_dir.'libs/Smarty.class.php';

  $smarty = new Smarty();
  $smarty->compile_check = true;
  $smarty->debugging = true;
  $smarty->template_dir = $smarty_dir.'templates/';
  $smarty->compile_dir = $smarty_dir.'templates_c/';
  $smarty->config_dir = $smarty_dir.'configs/';
  $smarty->cache_dir = $smarty_dir.'cache/';
    
  $citys = HtmlOption::getCitys($db);
  $categories = HtmlOption::getCategories($db);
        
  $smarty->assign('category', $categories);
  $smarty->assign('city', $citys);
  $smarty->assign('ads_radios', array('private' => 'Частное объявление', 'company' => 'Объявление Компании'));
  
  AdStorage::instance()->getAllAdsFromDb($db)->writeOut($smarty);
  
  $smarty->assign('ads_single', new AdPrivate());
  
  if( isset($_POST['main_form_submit']) ) {
    if ( isset($_GET['edit']) ) $_POST['id'] = $_GET['edit'];
    
    if ($_POST['type'] === 'private') {
      $ad = new AdPrivate($_POST);
    } else {
      $ad = new AdCompany($_POST);
    }
    $ad->save($db);
    header( "Location: ".$_SERVER['PHP_SELF'] );
  }
  
  if ( isset($_GET['edit']) ) {
    $adForEdit = AdStorage::instance()->getAdFromStorage($_GET['edit']);
    $smarty->assign( 'ads_single', $adForEdit );
    $smarty->assign('ads_btn_value', 'Сохранить');
  }
  
  $smarty->display('index.tpl');
?>

