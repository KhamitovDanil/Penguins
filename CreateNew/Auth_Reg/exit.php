<?php 

// setcookie('user', $user[0][0], time() - 3600, "/");
session_start();
unset($_SESSION["user_id"]);  
header('Location: /');

?>