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
    $image = time().$_FILES["image"]["name"];
    $qty = $_POST['quantity'] - $_POST['prevQuantity'];

    if (updateProduct($conn, $id, $name, $brandID, $catID, $volume, $price, $gender, $desc, $image)){
        updateStock($conn,$id ,$qty);
        echo '<script>alert("Product updated successfully")</script>';
        // upload image
        $target = 'uploads/products/';
        $target = $target.$image;

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target))
            echo '<script>alert("Something went wrong while uploading the product image!")</script>';

    }else echo ' <script>alert("Ops somthing went wrong!")</script>';
    header('refresh:0;url=products.php');
} else {
    header('location:products.php');
}
