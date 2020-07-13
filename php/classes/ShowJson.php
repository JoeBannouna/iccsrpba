<?php

class ShowJson extends Model {

  public function showAnnouncements($limit = false) {
    // Get all rows from the database
    $announcements = $this->getAllRows("announcements", $limit);
    $announcementsArr = [];

    // Print each announcement in an object
    foreach ($announcements as $announcement) {
      // Fix the dat format
      $announcement["date"] = date("m-d-Y", $announcement["date"]);
      $attributesArr = [];

      // Print each property in an object-like format
      foreach ($announcement as $key => $attribute) {
      $property = '"' . $key . '": "' . $attribute . '"';
        array_push($attributesArr, $property);
      }
      $announcementJson = "{" . implode(", ", $attributesArr) . "}";
      array_push($announcementsArr, $announcementJson);
    }
    $announcementsJson = "[" . implode(",", $announcementsArr) . "]";
    print_r($announcementsJson);
  }

  public function showCategories($limit = false) {
    // Get all rows from the database
    $categories = $this->getAllRows("categories", $limit);
    $this->log($categories);
    $categoriesArr = [];

    // Print each category in an object
    foreach ($categories as $category) {
      $attributesArr = [];

      // Print each property in an object-like format
      foreach ($category as $key => $attribute) {
      $property = '"' . $key . '": "' . $attribute . '"';
        array_push($attributesArr, $property);
      }
      // Add image property manually..
      $imageProperty = '"imgurl": "/images/categories/' . $category["id"] . '.png"';
      array_push($attributesArr, $imageProperty);
      
      // Implode the objects
      $categoryJson = "{" . implode(", ", $attributesArr) . "}";
      array_push($categoriesArr, $categoryJson);
    }
    $categoriesJson = "[" . implode(",", $categoriesArr) . "]";
    print_r($categoriesJson);
    $this->log($categoriesJson);
  }
}