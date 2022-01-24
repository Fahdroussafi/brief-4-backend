<?php

require_once 'connect.php';

function insertProduct($conn, $name, $brandID, $catID, $volume, $price, $gender, $desc, $image, $qty)
{
    $sql = "INSERT INTO `product` (`name`,`brandID`,`categoyID`,`volume`,`price`,`gender`,`image`,`description`) VALUES (?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('siiddsss', $name, $brandID, $catID, $volume, $price, $gender, $image, $desc);

    if ($stmt->execute()) {
        $lastInsertedId = $conn->insert_id;
        for ($i = 0; $i < $qty; $i++) {
            $stmt = $conn->prepare("INSERT INTO `stock` (`ref`, `id`) VALUES (NULL, ?)");
            $stmt->bind_param('i', $lastInsertedId);
            $stmt->execute();
        }
        return $conn->affected_rows;
    }

    return false;
}

function deleteProduct($conn, $productID)
{
    $stmt = $conn->prepare("DELETE FROM `product` WHERE `product`.`id` = ?");
    $stmt->bind_param('i', $productID);
    return $stmt->execute();
}

function getProducts($conn, $by = false, $value = false)
{

    $sql = "SELECT product.*,category.catName,brand.brandName, count(stock.id) as quantity,stock.ref 
    FROM (brand JOIN product JOIN category ON brand.brandID = product.brandID 
    AND product.categoyID = category.categoryID) 
    LEFT JOIN stock on stock.id = product.id  and stock.sold IS NULL";

    if ($by) {
        $stmt = $conn->prepare("$sql WHERE $by LIKE ? GROUP BY product.id");
        $stmt->bind_param("s", $value);
    } else {
        $stmt = $conn->prepare("$sql GROUP BY product.id");
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];

    while ($rec = $result->fetch_assoc()) {
        array_push($data, $rec);
    }

    return $data;
}

function getCategories($conn)
{
    $sql = "SELECT * FROM `category`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $categories = [];

    while ($rec = $result->fetch_assoc()) {
        array_push($categories, $rec);
    }

    return $categories;
}

function getBrands($conn)
{
    $sql = "SELECT * FROM `brand`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    $brands = [];

    while ($rec = $result->fetch_assoc()) {
        array_push($brands, $rec);
    }

    return $brands;
}

function sellProduct($conn, $ref)
{
    $today = date('Y-m-d');
    $stmt = $conn->prepare("UPDATE `stock` SET `sold` = '$today' WHERE `stock`.`ref`=?");
    $stmt->bind_param('i', $ref);
    return $stmt->execute();
}

function updateProduct($conn, $id, $name, $brandID, $catID, $volume, $price, $gender, $desc, $image)
{
    $sql = "UPDATE `product` SET `brandID` = ?, `categoyID` = ?, `name` = ?, `volume` = ?, `price` = ?, `gender` = ?, `image` = ?, `description` = ? WHERE `product`.`id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iisddsssi', $brandID, $catID, $name, $volume, $price, $gender, $image, $desc, $id);
    return $stmt->execute();
}

function updateStock($conn,$id ,$qty)
{
    for ($i = 0; $i < $qty; $i++) {
        $stmt = $conn->prepare("INSERT INTO `stock` (`ref`, `id`) VALUES (NULL, ?)");
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }
}
