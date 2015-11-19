<?php

  require('Ad.php');
  
  require('connect_to_db.php');

  if ( isset($_GET['delete']) ) {
    $adForDelete = new Ad();
    $adForDelete->setId($_GET['delete']);
    $adForDelete->delete($db);
  }
  
?>

