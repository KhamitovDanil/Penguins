<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<? require_once "header.php"; ?>
	<h1>Привет <?= $_COOKIE["user"]; ?>!</h1>
	<a href="exit.php">Чтобы выйти нажмите по ссылке.</a>

</body>
</html>
