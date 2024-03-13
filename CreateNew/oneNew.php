<?php
require "connect.php";
include "header.php";

session_start();
$user_id = isset($_SESSION["user_id"])?$_SESSION["user_id"]:false;

$new_id = isset($_GET["new"])?$_GET["new"]:false;

if ($new_id) {
    $query_getNew = "SELECT * FROM News WHERE news_id = '$new_id'";
    $new_info = mysqli_fetch_assoc(mysqli_query($con, $query_getNew));

    $comments_result = mysqli_query($con, "SELECT `comment_text`, `comment`, `username`
    FROM `Comments` INNER JOIN `Users` ON  Comments.user_id = Users.user_id
    WHERE `news_id`=$new_id ORDER BY `comment` DESC");
    $comments = mysqli_fetch_all($comments_result);

} else {
    header("Location: /");
}
function date_new($date_old) {
    $month = ['01' => 'Января' , '02' => 'Февраля' , '03' => 'Марта' , '04' => 'Апреля' , '05' => 'Мая' , '06' => 'Июня' , 
    '07' => 'Июля' , '08' => 'Августа' , '09' => 'Сентября' , '10' => 'Октября' , '11' => 'Ноября' , '12' => 'Декабря'];
    $date = date("d.m.Y H:i:s", strtotime($date_old));
    $m_text = $month[substr($date, 3, 2)];
    return substr($date, 0, 2) . " " . $m_text . " " . substr($date, 6);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OneNew</title>
    <style>
        .user-date {
            display: flex;
            justify-content: space-between;
        }

    </style>
</head>
<body>

<div class="container">
    <?php
        echo "<div class='one_new'><div class='page_img'><img src='images/news/" . $new_info['image'] . "'></div>";
        echo "<h1>" . $new_info['title'] . "</h1>";
        echo "<p>" . $new_info['content'] . "</p>";
        echo "<i>" . date_new($new_info["publish_date"]) . "</i>"; 
        echo "</div>";
    ?>
    <? if ($user_id) { ?>
        <form class="w-100" action="comments-db.php" method="POST">
            <div class="mb-3">
                <label for="comment_text">Напишите комментарий</label>
                <input type="text" class="form-control" id="comment_text" name="comment_text" required>
                <input type="hidden" name="id_new" value="<?= $new_id ?>">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    <? } ?>
    <h3 class="mb-3 d-flex align-items-center">Комментарии: <?= mysqli_num_rows($comments_result) ?><img src="images/news/comments.png" style="width: auto; height: 25px; margin-left: 5px" alt=""></h3>
    <?php if (mysqli_num_rows($comments_result)) {
        foreach ($comments as $comment) { ?>
        <div class="card text-left mb-3">
            <div class="card-header">
                <?= date_new($comment[1]); ?>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-body-secondary">
                    Автор: <?= $comment[2] ?>
                </h6>
                <p class="card-text">
                    <?= $comment[0]; ?>
                </p>
            </div>
        </div>
    <?php } 
    } else echo "<i>Комментариев пока нет</i>" ?>
</div>

</body>
</html>