<?php
include "../connect.php";

$title = isset($_POST['title'])?$_POST['title']:false;
$content = isset($_POST['content'])?$_POST['content']:false;
$file = ($_FILES['file-img']["size"] != 0)?$_FILES['file-img']:false;
$category_id = isset($_POST['category'])?$_POST['category']:false;
$id = isset($_POST['id'])?$_POST['id']:false;

function checkError($error) {
    echo "<script>alert('$error'); location.href='/admin'</script>";
}

$new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM News WHERE news_id=$id"));

$query_update = "UPDATE `News` SET ";
$checkUpdate = false;

if ($new_info["title"] != $title) { 
    $query_update .= " `title` = '$title',";
    $checkUpdate = true;
} 
if ($new_info["content"] != $content) {
    $query_update .= " `content` = '$content',";
    $checkUpdate = true;
} 
if ($new_info["category_id"] != $category_id) {
    $query_update .= " `category_id` = $category_id,";
    $checkUpdate = true;
} 
if ($file) {
    $query_update .= " `image` = " . $file["name"] . ",";
    move_uploaded_file($file["tmp_name"], "../images/news/".$file["name"]);
    $checkUpdate = true;
}

$query_update = substr($query_update, 0, -1);
$query_update .= " WHERE news_id = $id";

if ($checkUpdate) {
    var_dump($query_update);
    mysqli_query($con, $query_update);
    checkError("Данные успешно изменены");
} else {
    checkError("Данные не были изменены");
}