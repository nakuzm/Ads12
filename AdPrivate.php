<?php
  
  class AdPrivate extends Ad {
    protected $type = 'private';
    
    function __construct( $ad=NULL ) {
      parent::__construct( $ad );
    }
  }

?>

