<?php
session_start();

include("connection.php");
include("functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    if (!empty($username) && !empty($passwrd)) {

        //save to database
        $adminID = random_num(20);
        $query = "insert into admin (adminID,username,passwd) values ('$adminID','$username','$passwd')";

        mysqli_query($con, $query);

        header("Location: login.php");
        die;
    } else {
        echo "Please enter some valid information!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Poppins" rel="stylesheet">
    <title>SIGN UP || parfume.art</title>
</head>

<body>
    <div class="container">
        <div class="top">
            <img src="./assets/img/avatar.png" style="margin-bottom: 15px;" width="85px" height="85px" alt="Avatar">
        </div>
        <form class="form" method="post">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" placeholder="role@username" name="username">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input id="password" type="password" placeholder="Enter your password" name="passwd">
            </div>
            <button type="submit" value="signup">SIGNUP</button>
            <br>
            <a href="login.php">Click to login</a>
    </div>
    </form>

</body>

</html>