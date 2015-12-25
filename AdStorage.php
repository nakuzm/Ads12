<?php

  class AdStorage {
    private static $instance = NULL;
    private $ads = array();

    public static function instance() {
      if (self::$instance === NULL) {
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
        if ($adArray['type'] === 'private') {
          $ad = new AdPrivate($adArray);
        } else {
          $ad = new AdCompany($adArray);
        }
        
        $this->addAds($ad);
      }
      
      return self::$instance;
    }
    
    public function getAdFromDb($db,$id) {
      if (is_null($id)) {
        $adArray = $db->selectRow('SELECT * FROM ads ORDER BY id DESC LIMIT 0,1');
      }
      else {
        $adArray = $db->selectRow('SELECT * FROM ads WHERE id = ?', $id);
      }
      
      if ($adArray['type'] === 'private') {
        $ad = new AdPrivate($adArray);
      } else {
        $ad = new AdCompany($adArray);
      }
      $this->addAds($ad);
      return self::$instance;
    }
    
    public function writeOut($smarty) {
      $rows = '';
      foreach ($this->ads as $ad) {
        if ($ad instanceof AdCompany) {
          $rows .= '<tr class="info">';
        } else {
          $rows .= '<tr>';
        }
        $smarty->assign('ad', $ad); 
        $rows .= $smarty->fetch('table_row.tpl');
        $rows .= '</tr>';
      }
      return $rows;
    }
    
    public function getAdFromStorage($number) {
      return $this->ads[$number];
    }    

  }
  
?>

