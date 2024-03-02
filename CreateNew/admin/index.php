<?php
include "../connect.php";
include "../header.php";
$categories = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM Categories"));

$news = mysqli_fetch_all(mysqli_query($con, "SELECT news_id, title FROM News"));
$id_new = isset($_GET["new"])?$_GET["new"]:false;

if($id_new) $new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM News WHERE news_id=$id_new"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <style>
        .c_img,
        .c_img img {
            height: 100px;
            width: auto;            
        }
        li a img {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>


<div class="container">
    <h1>Панель администратора</h1>
    <div class="admin_content">
        <section class="col_1">
            <h2>Список новостей:</h2>
            <ul>
                <?php
                    foreach ($news as $new) {
                        echo "<li><a href='?new=" . $new[0] . "'>" . $new[1] . "</a>;
                        <a href='deleteNewValid.php?new=" . $new[0] . "'><img src='../images/trash.png'></a>
                        </li><hr>";
                    }
                ?>
                <a href="/admin"><img src="../images/news/plus.png" alt=""></a>
            </ul>
        </section>
        <section class="col_2">
            <h2> <?=$id_new?"Редактирование новости №$id_new":"Создание новости";?> </h2>
            <div class="container">
            <form action=<?=$id_new?"update":"create";?>NewValid.php class="new__value" method="POST" enctype="multipart/form-data">
                <div class="title">
                    <label for="title">Введите заголовок:</label>
                    <input type="text" id="title" name="title" value="<?=$id_new?$new_info["title"]:''?>">
                </div>
                <div class="content">
                    <label for="content">Введите описание:</label>
                    <input type="textarea" id="content" name="content" value="<?=$id_new?$new_info["content"]:''?>">
                </div>
                <div class="image">
                    <input type="file" name="file-img" accept="/image*">
                    <label for="file-img">Выберите картинку:</label>
                    <?= $id_new?("<div class='c_img'><img src='../images/news/" . $new_info['image'] . "' alt=''></div>"):"";?>
                    <?= $id_new?("<input type='hidden' id='id' name='id' value='$id_new'>"):"";?>
                </div>
                <div class="category">
                    <label for="category">Выберите категорию:</label>
                    <select id="category" name="category">
                    <?php
                        foreach ($categories as $category) {
                            $id_cat = $category[0];
                            $name = $category[1];
                            $is_sel = ($id_cat==$new_info['category_id'])?"selected":'';
                            echo "<option value='$id_cat' $is_sel>$name</option>";
                        }
                    ?>
                    </select>
                </div>
                <div class="submit">
                    <label for="submit"></label>
                    <input type="submit" id="submit" name="submit" value="Подтвердить">
                </div>
            </form>
            </div>
        </section>
    </div>
</div>

</body>
</html>