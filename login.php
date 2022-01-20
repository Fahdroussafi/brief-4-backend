<?php

session_start();

include("connection.php");
include("functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$username = $_POST['username'];
	$passwd = $_POST['passwd'];

	if (!empty($username) && !empty($passwd) && !is_numeric($username)) {

		//read from database
		$query = "select * from admin where username = '$username' limit 1";
		$result = mysqli_query($con, $query);

		if ($result) {
			if ($result && mysqli_num_rows($result) > 0) {

				$user_data = mysqli_fetch_assoc($result);

				if ($user_data['passwd'] === $passwd) {

					$_SESSION['adminID'] = $user_data['adminID'];
					header("Location: dashbord.php");
					die;
				}
			}
		}

		echo "wrong username or password!";
	} else {
		echo "wrong username or password!";
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
			<br>
			<a href="signup.php">Click to SIGNUP</a>
	</div>
	</form>

</body>

</html>