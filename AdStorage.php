<?php

  class AdStorage {
    private static $instance = NULL;
    private $ads = array();

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
        if ($adArray['type'] == 'private') {
          $ad = new AdPrivate($adArray);
        } else {
          $ad = new AdCompany($adArray);
        }
        
        $this->addAds($ad);
      }
      
      return self::$instance;
    }
    
    public function writeOut($smarty) {
      $row = '';
      foreach ($this->ads as $ad) {
        if ($ad instanceof AdCompany) {
          $row .= '<tr class="info">';
        } else {
          $row .= '<tr>';
        }
        $smarty->assign('ad', $ad); 
        $row .= $smarty->fetch('table_row.tpl');
        $row .= '</tr>';
      }
      $smarty->assign('ads_rows', $row);
      
      return self::$instance;
    }
    
    public function getAdFromStorage($number) {
      return $this->ads[$number];
    }

  }
  
?>

