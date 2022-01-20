<?php

function check_login($con)
{

	if (isset($_SESSION['adminID'])) {

		$id = $_SESSION['adminID'];
		$query = "select * from admin where adminID= '$id' limit 1";

		$result = mysqli_query($con, $query);
		if ($result && mysqli_num_rows($result) > 0) {

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;
}

function random_num($length)
{

	$text = "";
	if ($length < 5) {
		$length = 5;
	}

	$len = rand(4, $length);

	for ($i = 0; $i < $len; $i++) {
		# code...

		$text .= rand(0, 9);
	}

	return $text;
}


if (isset($_POST["add"])) {
	$id = $_POST['id'];
	$brandID = $_POST['brandID'];
	$categoryID = $_POST['categoryID'];
	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$volume = $_POST['volume'];
	$price = $_POST['price'];
	$image = $_POST['image'];
	$descripton = $_POST['description'];
	session_start();
	// $product=$_SESSION['product'];
	$cx = mysqli_connect("localhost", "root", "", "parfum.art");
	$qy = "insert into product values('$id','$brandID','$categoryID','$name','$gender','$volume','$price','$image',
'$description')";
	mysqli_query($cx, $qy);
	mysqli_close($cx);
}
