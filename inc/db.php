<?php

require_once 'connect.php';

function getProducts($conn,$by = false,$value = false){

    if($by){
        $stmt = $conn->prepare("SELECT * FROM product WHERE $by LIKE ?");
        $stmt->bind_param("s", $value);
    }else{$stmt = $conn->prepare("SELECT * FROM product");}
    
    $stmt->execute();
    $result = $stmt->get_result(); 

    $data = [];

    while($rec = $result->fetch_assoc()){
        array_push($data,$rec);
    }
    
    return $data;
}

