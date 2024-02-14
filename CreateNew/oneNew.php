<?php
require "connect.php";
include "header.php";

$new_id = isset($_GET["new"])?$_GET["new"]:false;

$query_getNew = "SELECT * FROM News WHERE news_id = '$new_id'";
$new_info = mysqli_fetch_assoc(mysqli_query($con, $query_getNew));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OneNew</title>
</head>
<body>

<nav>
    <div class="n_title">
        <div class="container d-flex justify-content-center">
            <?php
                $month = ['01' => 'Января' , '02' => 'Февраля' , '03' => 'Марта' , '04' => 'Апреля' , '05' => 'Мая' , '06' => 'Июня' , 
                '07' => 'Июля' , '08' => 'Августа' , '09' => 'Сентября' , '10' => 'Октября' , '11' => 'Ноября' , '12' => 'Декабря'];
                $date = date("d.m.Y H:i:s", strtotime($new_info['publish_date']));
                $m_text = $month[substr($date, 3, 2)];
                $publish_date = substr($date, 0, 2) . " " . $m_text . " " . substr($date, 6);

                echo "<div class='one_new'><div class='page_img'><img src='images/news/" . $new_info['image'] . "'></div>";
                echo "<h1>" . $new_info['title'] . "</h1>";
                echo "<p>" . $new_info['content'] . "</p>";                 
                echo "<i>" . $publish_date . "</i>"; 
                echo "</div>";
            ?>
        </div>
    </div>
</nav>

</body>
</html>