<?php

session_start();
if (isset($_SESSION['logedIn']) && $_SESSION['logedIn']) header('location: dashboard.php');
require_once 'inc/db.login.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$user = $_POST['username'];
	$passwd = $_POST['passwd'];

	if (!empty($user) && !empty($passwd)) {
		if (filter_var($user, FILTER_VALIDATE_EMAIL)) {
			if ($info = adminExist($conn,$user,$passwd)) {
				$_SESSION['logedIn'] = true;
				$_SESSION['role'] = 'admin';
				$_SESSION['user'] = $info;
				header('location:dashboard.php');
			}
		}elseif($info = employeeExist($conn,$user,$passwd)){
				$_SESSION['logedIn'] = true;
				$_SESSION['role'] = 'employee';
				$_SESSION['user'] = $info;
				header('location:dashboard.php');
		}else{
			echo "<script>alert('Username or password uncorrect!')</script>";
		}
	} else {
		echo "<script>alert('All fields are required!')</script>";
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
	<title>Login || parfume.art</title>
</head>

<body>
	<div class="container">
		<div class="top">
			<img src="./assets/img/avatar.png" style="margin-bottom: 15px;" width="85px" height="85px" alt="Avatar">
		</div>
		<form class="form" method="POST">
			<div class="input-group">
				<label for="username">Username</label>
				<input type="text" placeholder="role@username" name="username">
			</div>
			<div class="input-group">
				<label for="password">Password</label>
				<input id="password" type="password" placeholder="Enter your password" name="passwd">
			</div>
			<button type="submit" value="Login">LOGIN</button>
	</div>
	</form>

</body>

</html>