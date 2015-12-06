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
  
  $smarty_dir = __DIR__.'/smarty/';
  require_once $smarty_dir.'libs/Smarty.class.php';
  
  $smarty = new Smarty();
  $smarty->compile_check = true;
  $smarty->debugging = true;
  $smarty->template_dir = $smarty_dir.'templates/';
  $smarty->compile_dir = $smarty_dir.'templates_c/';
  $smarty->config_dir = $smarty_dir.'configs/';
  $smarty->cache_dir = $smarty_dir.'cache/';
  
  if ( !empty($_POST) ) {
        
    if ($_POST['type'] === 'private') {
      $ad = new AdPrivate($_POST);
    } else {
      $ad = new AdCompany($_POST);
    }
    $ad->save($db);
    
    $citys = HtmlOption::getCitys($db);
    $categories = HtmlOption::getCategories($db);
    $smarty->assign('category', $categories);
    $smarty->assign('city', $citys);
    $smarty->assign('ads_radios', array('private' => 'Частное объявление', 'company' => 'Объявление Компании'));

    AdStorage::instance()->getAllAdsFromDb($db)->writeOut($smarty);
    $smarty->assign('ads_single', new AdPrivate());
    $smarty->display('index.tpl');
    
  } elseif ( isset($_GET['action']) ) {
    
    switch ( $_GET['action'] ) {

      case 'delete':
        $ad = new Ad();
        $ad->setId($_GET['id']);
        echo $ad->delete($db);  		
        break;

      case 'edit':
        $citys = HtmlOption::getCitys($db);
        $categories = HtmlOption::getCategories($db);
        $smarty->assign('category', $categories);
        $smarty->assign('city', $citys);
        $smarty->assign('ads_radios', array('private' => 'Частное объявление', 'company' => 'Объявление Компании'));

        AdStorage::instance()->getAllAdsFromDb($db)->writeOut($smarty);
        $adForEdit = AdStorage::instance()->getAdFromStorage($_GET['id']);
        $smarty->assign( 'ads_single', $adForEdit );
        $smarty->assign('ads_btn_value', 'Сохранить');
        $smarty->display('index.tpl');
        break;

      default:
        break;
    }    
    
  } else {  
    $citys = HtmlOption::getCitys($db);
    $categories = HtmlOption::getCategories($db);
    $smarty->assign('category', $categories);
    $smarty->assign('city', $citys);
    $smarty->assign('ads_radios', array('private' => 'Частное объявление', 'company' => 'Объявление Компании'));

    AdStorage::instance()->getAllAdsFromDb($db)->writeOut($smarty);
    $smarty->assign('ads_single', new AdPrivate());
    
    $smarty->display('index.tpl');
  }

?>

