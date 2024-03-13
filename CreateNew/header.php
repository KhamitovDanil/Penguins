<?php
session_start();
$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:false;
require "connect.php";
$items = mysqli_query($con, "SELECT * FROM Categories");
$all = mysqli_fetch_all($items);
$sort = isset($_GET["sort"])?$_GET["sort"]:false;
$search = isset($_GET["search"])?$_GET["search"]:false;
$category = isset($_GET["category"])?$_GET["category"]:false;

if ($user_id) {
    $username = mysqli_fetch_assoc(mysqli_query($con, "SELECT `username` FROM `Users` WHERE `user_id`=$user_id"));
}
?>
<head>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<header class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="/"><img style="width: auto; height: 80px;" src="images/logo.png" alt="Logo"><h1 class='main_h1' onclick="location.href='/'">Пингвины</h1></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <? if (!$user_id) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="Auth_Reg/reg.php">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Auth_Reg/auth.php">Авторизация</a>
                </li>
                <? } else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="Auth_Reg/exit.php">Выход</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php"><?= $username["username"]; ?></a>
                </li>
                <? } ?>

            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php if ($search) echo $search ?>">
                <button class="btn btn-outline-success" type="submit">Поиск</button>
                <? if ($category) { ?>
                    <input type="hidden" name="category" value="<?= $category ?>">
                <? } ?>
                <? if ($sort) { ?>
                    <input type="hidden" name="sort" value="<?= $sort ?>">
                <? } ?>
            </form>
        </div>
    </div>
    </nav>
    <div class="links">
        <ul class="container links">
        <?php
            foreach ($all as $elem) {
                echo "<li><a href='index.php?category=$elem[0]'>" . $elem[1] . "</a></li>";
            }
        ?>
        </ul>
    </div>
</header>
<script>
    $("#search").keypress(function(event) {
        if (event.which === 13) {
            $("#search").submit();
        }
    });
</script>