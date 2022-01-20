<?php

session_start();

if (isset($_SESSION['adminID'])) {
	unset($_SESSION['adminID']);
}

header("Location: login.php");
die;
