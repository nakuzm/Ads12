<?php

  class Ad {
    
    protected $id;
    protected $type = 'private';
    protected $seller_name = "";
    protected $email = "";
    protected $phone = "";
    protected $location_id = "";
    protected $category_id = "";
    protected $title = "";
    protected $description = "";
    protected $price = 0;
    protected $allow_mails = 0;
      
    function __construct( $ad=NULL ) {
      if(!$ad) return;
      
      if( isset($ad['id']) ) {
        $this->id=$ad['id'];
      }
      $this->type = $ad['type'];
      $this->seller_name = $ad['seller_name'];
      $this->email = $ad['email'];
      $this->phone = $ad['phone'];
      $this->location_id = $ad['location_id'];
      $this->category_id = $ad['category_id'];
      $this->title = $ad['title'];
      $this->description = $ad['description'];
      $this->price = $ad['price'];
      
      if( isset($ad['allow_mails']) ) {
        $this->allow_mails = $ad['allow_mails'];
      }
    }
    
    function getType() {
      return $this->type;
    }
    
    function getId() {
      return $this->id;
    }
    
    function getSellerName() {
      return $this->seller_name;
    }
    
    function getEmail() {
      return $this->email;
    }
    
    function getPhone() {
      return $this->phone;
    }
    
    function getLocationId() {
      return $this->location_id;
    }
    
    function getCategoryId() {
      return $this->category_id;
    }
    
    function getTitle() {
      return $this->title;
    }
    
    function getDescription() {
      return $this->description;
    }
    
    function getPrice() {
      return $this->price;
    }
    
    function getAllowMails() {
      return $this->allow_mails;
    }
    
    public function save($db) {
      $vars = get_object_vars($this);
      $db->query("REPLACE INTO ads(?#) VALUES(?a)", array_keys($vars), array_values($vars));
    }

    static function delete($ad_nr, $db) {
      $db->query("DELETE FROM ads WHERE id = ?n", $ad_nr);
    }
  }
  
?>

