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
    
    public function getType() {
      return $this->type;
    }
    
    public function getId() {
      return $this->id;
    }
    
    public function getSellerName() {
      return $this->seller_name;
    }
    
    public function getEmail() {
      return $this->email;
    }
    
    public function getPhone() {
      return $this->phone;
    }
    
    public function getLocationId() {
      return $this->location_id;
    }
    
    function getCategoryId() {
      return $this->category_id;
    }
    
    public function getTitle() {
      return $this->title;
    }
    
    public function getDescription() {
      return $this->description;
    }
    
    public function getPrice() {
      return $this->price;
    }
    
    public function getAllowMails() {
      return $this->allow_mails;
    }
    
    public function save($db) {
      $vars = get_object_vars($this);
      $db->query("REPLACE INTO ads(?#) VALUES(?a)", array_keys($vars), array_values($vars));
    }

    public function delete($ad_nr, $db) {
      $db->query("DELETE FROM ads WHERE id = ?n", $ad_nr);
    }
  }
  
?>

