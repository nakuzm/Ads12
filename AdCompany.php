<?php

  class AdCompany extends Ad {
    protected $type = 'company';
    
    function __construct( $ad=NULL ) {
      parent::__construct( $ad );
    }
  }
  
?>

