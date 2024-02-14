<?php
require "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinguins/Main</title>
    <style>
        .c_img,
        .c_img img {
            width: auto;
            height: 150px;
        }
    </style>
</head>
<body>
<?php
require_once "header.php";

$query_news = "SELECT * FROM News";
$news = mysqli_query($con, $query_news);
?>

<section class="last-news">
    <div class="container d-flex flex-wrap">
        <?php
        $a = count(mysqli_fetch_all($news)); 
        if ($a == 0) {
            echo "<h2>К сожалению новостей на данную категорию нет.</h2>";
        }
        foreach ($news as $new) {                 
            echo "<div class='card'>";
            $new_id = $new["news_id"];
            echo "<div class='c_img'><img src='images/news/" . $new['image'] . "' alt=''></div>";
            echo "<h2 class='c_title'>" . $new['title'] . "</h2>";
            echo "<a href='oneNew.php?new=" . $new["news_id"] . "'>" . $new['title'] . "</a></div>";
        }
        ?>
    </div>
</section>

</body>
</html>