<?php
$login = filter_var(trim($_POST['login']), FILTER_UNSAFE_RAW);
$pass = filter_var(trim($_POST['pass']), FILTER_UNSAFE_RAW);

require "connectDB.php";
$user = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM `Users` WHERE `email`='$login'"));

if (count($user) == 0) {
    echo "<script>alert('Такой пользователь не найден');
        location.href='auth.php';
    </script>";
} else if (count($user) == 1 && $pass != $user[0][2]) {
    echo "<script>alert('Неверный пароль');
        location.href='auth.php';
    </script>";
} else {
    session_start();
    $_SESSION["user_id"] = $user[0][0];
    echo "<script>alert('Авторизация прошла успешно!')</script>";
    header('Location: page.php');

    // setcookie('user', $user[0][0], time() + 3600, "/");
}
?>