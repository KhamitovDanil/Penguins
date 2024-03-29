<?php
require "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
$category = isset($_GET["category"])?$_GET["category"]:false;
$sort = isset($_GET['sort'])?$_GET['sort']:false;
$search = isset($_GET["search"])?$_GET["search"]:false;
$page = isset($_GET["page"])?$_GET["page"]:1; // значение текущей страницы
$query_news = "SELECT * FROM News ";

$paginate_count = 2; // число новостей на одной странице
$offset = $page * $paginate_count - $paginate_count; // смещение

if ($category) {
    $query_news .= "WHERE category_id = $category ";
}
if ($category and $search) {
    $query_news .= "AND title LIKE '%$search%' ";
} else if ($search) {
    $query_news .= "WHERE title LIKE '%$search%' ";
}
if ($sort and $sort != "") {
    $query_news .= "ORDER BY $sort ";
}

$count_news = mysqli_num_rows(mysqli_query($con, $query_news)); // общее число новостей
$query_news .= "LIMIT $paginate_count OFFSET $offset ";

echo "<div class='container'>$query_news</div>";

$news = mysqli_query($con, $query_news);

?>

<section class="last-news">
    <div class="container d-flex flex-wrap">
        <h2>Сортировка</h2>
        <form id="sort-form" action="" method="GET">
            <select id="sort-select" class="form-select" aria-label="Default select example" name="sort">
                <option value="publish_date ASC" <?= ($sort and $sort == "publish_date ASC")?"selected":""?>>Дата публикации | ASC</option>
                <option value="publish_date DESC" <?= ($sort and $sort == "publish_date DESC")?"selected":""?>>Дата публикации | DESC</option>
                <? if (isset($_GET["category"])) { ?>
                <input type="hidden" name="category" value="<?= $_GET["category"] ?>">
                <? } ?>
                <? if (isset($_GET["search"])) { ?>
                <input type="hidden" name="search" value="<?= $_GET["search"] ?>">
                <? } ?>
                <input type="hidden" name="page" value="<?= $page ?>">
            </select>
        </form>
    </div>
    <div class="container d-flex flex-wrap">
        <?php
        $a = count(mysqli_fetch_all($news)); 
        if ($a == 0) {
            echo "<h2>К сожалению новостей на данную категорию нет.</h2>";
        }
        foreach ($news as $new) {
            echo "<div class='card'>";
            $new_id = $new["news_id"];
            echo "<div>$new_id</div>";
            echo "<div class='c_img'><img src='images/news/" . $new['image'] . "' alt=''></div>";
            echo "<h2 class='c_title'>" . $new['title'] . "</h2>";
            echo "<a href='oneNew.php?new=" . $new["news_id"] . "'>" . $new['title'] . "</a></div>";
        }
        ?>
    </div>
    <br>
    <div class="container d-flex flex-wrap">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>

                <?php for ($i = 1; $i <= ceil($count_news / $paginate_count); $i++) { ?>
                    <li class="page-item"><a class="page-link" href="?page=<?=$i;?>
                    <?php if ($sort) echo "&sort=".$sort;
                        if ($category) echo "&category=". $category;
                        if ($search) echo "&search=". $search;?>
                        "><?=$i?></a></li>
                <?php } ?>

                <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</section>




<script>
    $("#sort-select").change(function() {
        $("#sort-form").submit();
    });
</script>

</body>
</html>