<?php

  function readData($fileName) {
    $dataSerialized = file_get_contents($fileName);
    $data = unserialize($dataSerialized);
    return $data;
  }
  
?>
