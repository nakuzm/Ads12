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
  
  if (!empty($_GET['action']) && $_GET['action'] === 'delete') {
    $ad = new Ad();
    $ad->setId($_GET['id']);
    echo $ad->delete($db);
    die();
  }
  
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
    $id = (!empty($_POST['id'])) ? $_POST['id'] : null;
    if ($_POST['type'] === 'private') {
      $ad = new AdPrivate($_POST);
    } else {
      $ad = new AdCompany($_POST);
    }
    $ad->save($db);
    $row = AdStorage::instance()->getAdFromDb($db,$id)->writeOut($smarty);
    echo $row;
    die();
  }

  $citys = HtmlOption::getCitys($db);
  $categories = HtmlOption::getCategories($db);
  $smarty->assign('category', $categories);
  $smarty->assign('city', $citys);
  $smarty->assign('ads_radios', array('private' => 'Частное объявление', 'company' => 'Объявление Компании'));
  
  if (!empty($_GET['action']) && $_GET['action'] === 'edit') {
    $adForEdit = AdStorage::instance()->getAdFromDb($db,$_GET['id'])->getAdFromStorage($_GET['id']);
    $adForEditArray = AdStorage::instance()->objectToArray($adForEdit);
    $adForEditArray['main_form_submit'] = 'Сохранить';
    echo json_encode($adForEditArray);
    die();
  }
  
  if (!empty($_GET['action']) && $_GET['action'] === 'clear') {
    $adForEditArray = AdStorage::instance()->objectToArray(new AdPrivate());
    $adForEditArray['main_form_submit'] = 'Отправить';
    echo json_encode($adForEditArray);
    die();
  }

  $rows = AdStorage::instance()->getAllAdsFromDb($db)->writeOut($smarty);
  $smarty->assign('ads_rows', $rows);
  $smarty->assign('ads_single', new AdPrivate());
  $smarty->display('index.tpl');

?>

