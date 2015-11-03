<?php

  class HtmlOption {
    static function getCitys($db) {
      $resultCity = $db->selectCol("SELECT id AS ARRAY_KEY, name FROM citys");
      return $resultCity;
    }

    static function getCategories($db) {
      $resultCtg = $db->select("SELECT id AS ARRAY_KEY, name, parent_id AS PARENT_KEY FROM Categories");  
      $ctgModify = [];
      foreach ($resultCtg as $parentId => $parentVal) {
        $ctgModify[$parentVal['name']] = $parentVal['childNodes'];
      }
      foreach ($ctgModify as $parentName => $parentArr) {
        foreach ($parentArr as $key => $item) {
          $parentArr[$key] = $item['name'];
        }
        $ctgModify[$parentName] = $parentArr;
      }
      return $ctgModify;
    }
  }

?>