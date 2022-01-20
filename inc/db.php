<?php

require_once 'connect.php';

function getProducts($conn,$by = false,$value = false){

    $sql = "SELECT product.*,category.catName,brand.brandName, count(stock.id) as quantity 
    FROM (brand JOIN product JOIN category ON brand.brandID = product.brandID 
    AND product.categoyID = category.categoryID) 
    JOIN stock on stock.id = product.id";

    if($by){
        $stmt = $conn->prepare("$sql WHERE $by LIKE ? GROUP BY product.id");
        $stmt->bind_param("s", $value);
    }else{$stmt = $conn->prepare("$sql GROUP BY product.id");}
    
    $stmt->execute();
    $result = $stmt->get_result(); 

    $data = [];

    while($rec = $result->fetch_assoc()){
        array_push($data,$rec);
    }
    
    return $data;
}

