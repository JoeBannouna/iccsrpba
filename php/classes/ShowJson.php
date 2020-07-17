<?php

class ShowJson extends Model {

  protected function LoopServices($services) {
    $servicesArr = [];

    // PRINT THE SERVICES
    foreach ($services as $service) {
      $attributesArr = [];

      // Print each property in an object-like format
      foreach ($service as $key => $attribute) {
        $attribute = preg_replace("/\"/", "&quot;", $attribute);
        $attribute = preg_replace("/\\\/", "&#92;", $attribute);
        $attribute = preg_replace("/\r|\n/", "", $attribute);
        $property = '"' . $key . '": "' . $attribute . '"';
        array_push($attributesArr, $property);
      }
      // Add image property manually..
      $imageProperty = '"imgurl": "/images/services/' . $service["id"] . '.png"';
      array_push($attributesArr, $imageProperty);
      
      // Implode the objects
      $serviceJson = "{" . implode(", ", $attributesArr) . "}";
      array_push($servicesArr, $serviceJson);
    }

    $servicesJson = "[" . implode(",", $servicesArr) . "]";
    return $servicesJson;
  }

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
        $attribute = preg_replace("/\"/", "&quot;", $attribute);
        $attribute = preg_replace("/\\\/", "&#92;", $attribute);
        $attribute = preg_replace("/\r|\n/", "", $attribute);
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
        $attribute = preg_replace("/\"/", "&quot;", $attribute);
        $attribute = preg_replace("/\\\/", "&#92;", $attribute);
        $attribute = preg_replace("/\r|\n/", "", $attribute);
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

  public function showCategory($catId, $limit = false) {
    // Get all rows from the database
    $services = $this->getRows($catId, "cat_id", "services", $limit);
    $servicesJson = $this->LoopServices($services);

    // PRINT THE CATEGORY
    @$categoryRow = $this->getRows($catId, "id", "categories")[0];
    if ($categoryRow === null) throw new Exception("Category not found", 404);
    $category = ["id" => $categoryRow["id"], "name" => $categoryRow["name"], "imgurl" => $categoryRow["id"] . ".png"];
    $attributesArr = [];

    // Print each property in an object-like format
    foreach ($category as $key => $attribute) {
      $attribute = preg_replace("/\"/", "&quot;", $attribute);
      $attribute = preg_replace("/\\\/", "&#92;", $attribute);
      $attribute = preg_replace("/\r|\n/", "", $attribute);
      $property = '"' . $key . '": "' . $attribute . '"';
      array_push($attributesArr, $property);
    }
    // Add service property manually..
    $servicesProperty = '"services": ' . $servicesJson;
    array_push($attributesArr, $servicesProperty);
    
    // Implode the objects
    $categoryJson = "{" . implode(", ", $attributesArr) . "}";

    print_r($categoryJson);
    $this->log($categoryJson);
  }

  public function showServices($limit = false, $catId = false) {
    
    if ($catId !== false) {                   // Get services from a certan category
      $services = $this->getRows($catId, "cat_id", "services", $limit);
      $servicesJson = $this->LoopServices($services);

      $this->log($servicesJson);
    } elseif ($catId === false) {             // Get ALL services
      $services = $this->getAllRows("services", $limit);
      $servicesJson = $this->LoopServices($services);
    }
    
    print_r($servicesJson);
    $this->log($servicesJson);
 }

  public function showCardPage($cardId) {
    // Get the Card from the database
    $cards = $this->getRows($cardId, "id", "services");
    $cardsArr = [];

    // Print each announcement in an object
    foreach ($cards as $card) {
      // Fix the dat format
      $card["date"] = date("m-d-Y", $card["date"]);
      $attributesArr = [];

      // Print each property in an object-like format
      foreach ($card as $key => $attribute) {
        $attribute = preg_replace("/\"/", "&quot;", $attribute);
        $attribute = preg_replace("/\\\/", "&#92;", $attribute);
        $attribute = preg_replace("/\r|\n/", "", $attribute);
        $attribute = utf8_encode($attribute);
        $property = '"' . $key . '": "' . $attribute . '"';
        array_push($attributesArr, $property);
      }
      $cardJson = "{" . implode(", ", $attributesArr) . "}";
      array_push($cardsArr, $cardJson);
    }
    $cardsJson = implode(",", $cardsArr);
    print_r($cardsJson);
  }
}