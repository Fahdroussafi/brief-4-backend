<?php

require_once 'inc/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateProduct'])) {

    $id = $_POST['id'];
    $name = $_POST['name'];
    $brandID = $_POST['brand'];
    $catID = $_POST['category'];
    $volume = $_POST['volume'];
    $price = $_POST['price'];
    $gender = $_POST['gender'];
    $desc = $_POST['desc'];
    $image = $_POST['image'];
    $qty = $_POST['quantity'];

    if (updateProducts($conn, $id, $name, $brandID, $catID, $volume, $price, $gender, $desc, $image))
        echo '<script>alert("Product updated successfully")</script>';
    else echo ' <script>alert("Ops somthing went wrong!")</script>';
    header('refresh:0;url=products.php');
} else {
    header('location:products.php');
}
