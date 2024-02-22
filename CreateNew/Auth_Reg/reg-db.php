<?php 
$login = filter_var(trim($_POST['login']), FILTER_UNSAFE_RAW); // Удаляет все лишнее и записываем значение в переменную //$login
$name = filter_var(trim($_POST['name']), FILTER_UNSAFE_RAW);
$pass = filter_var(trim($_POST['pass']), FILTER_UNSAFE_RAW); 

function exitPage() {
	echo "<script>location.href='reg.php';</script>";
}

require "connectDB.php";

if (empty($login) || empty($name) || empty($pass)) {
	echo "<script>alert('Заполните все данные!');</script>";
	exitPage();
}

$result1 = mysqli_query($conn,"SELECT * FROM `Users` WHERE `email` = '$login'");
$user1 = mysqli_fetch_assoc($result1); // Конвертируем в массив
if (!empty($user1)){
	echo "<script>alert('Данный логин уже используется!');</script>";
	exitPage();
} else if (mb_strlen($login) < 5 || mb_strlen($login) > 100){
	echo "<script>alert('Недопустимая длина логина');</script>";
	exitPage();
} else {
	mysqli_query($conn,"INSERT INTO `Users` (`email`, `password`, `username`)VALUES('$login', '$pass', '$name')");
	echo "<script>location.href='auth.php'</script>";
}