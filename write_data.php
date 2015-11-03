<?php

  function writeData($data, $fileName) {
    $dataSerialized = serialize($data);
    $stream = fopen($fileName, 'w');
    fwrite($stream, $dataSerialized);
    fclose($stream);
  }
  
?>
