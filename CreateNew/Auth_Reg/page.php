<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	require_once "header.php"; 
	require "../connect.php";
	session_start();
	$user_id = $_SESSION["user_id"];
	$user_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `Users` WHERE user_id=$user_id"))
	?>
	<h1>Привет <?= $user_info["username"]; ?>!</h1>
	<a href="exit.php">Чтобы выйти нажмите по ссылке.</a>

</body>
</html>
