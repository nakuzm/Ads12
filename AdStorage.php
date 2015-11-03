<?php

  class AdStorage {
    private static $instance = NULL;
    private $ads = array();
    
    function __construct() {
    }

    public static function instance() {
      if (self::$instance == NULL) {
        self::$instance = new AdStorage();
      }
      
      return self::$instance;
    }
    
    protected function addAds(Ad $ad) {
      if ( !($this instanceof AdStorage) ) {
        die("Нельзя использовать этот метод в конструкторе классов.");
      }
      $this->ads[$ad->getId()] = $ad;
    }

    public function getAllAdsFromDb($db) {
      $all = $db->select('select * from ads');
      
      foreach ($all as $adArray) {
        $ad = new Ad($adArray);
        $this->addAds($ad);
      }
      
      return self::$instance;
    }
    
    public function writeOut($smarty) {
      $row = '';
      foreach ($this->ads as $ad) {
        $smarty->assign('ad', $ad); 
        $row .= $smarty->fetch('table_row.tpl');
      }
      $smarty->assign('ads_rows', $row);
      $smarty->assign( 'ads_single', new Ad() );
    }
    
    public function writeOutSingle($smarty, $number) {
      $smarty->assign( 'ads_single', $this->ads[$number] );
    }
    
  }
  
?>

