<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Profile</title>
</head>
<body>
<?php 
require_once "header.php";
require "connect.php";
?>

<?php
session_start();
var_dump($_SESSION);
$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:false;
if ($user_id) {
    $query_user = mysqli_query($con, "SELECT * FROM `Users` WHERE user_id=$user_id");
    $user_info = mysqli_fetch_assoc($query_user);
}
?>

<div class="container">
    <form method="GET" action="" class="user_info">
        <?php 
        global $query_user;
        if ($query_user) {
            echo "<input type='text' name='username' value='" . $user_info['username'] . "' readonly>";
            echo "<input type='text' name='email' value='" . $user_info['email'] . "' readonly>";
        }
        ?>

    </form>
    
</div>

</body>
</html>