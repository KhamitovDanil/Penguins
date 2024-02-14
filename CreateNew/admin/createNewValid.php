<html>
    <head>
    </head>
<body>
<?php
    require "../connect.php";
   
    $title = isset($_POST['title'])?$_POST['title']:false;
    $content = isset($_POST['content'])?$_POST['content']:false;
    $file = isset($_FILES['file-img']['name'])?$_FILES['file-img']['name']:false;
    $category_id = isset($_POST['category'])?$_POST['category']:false;
    

    function checkError($error) {
        return "<script>alert('$error'); location.href='/admin';</script>";
    }


    if ($title and $content and $file and $category_id) {
        if (strlen($title) > 30) {
            echo checkError('Больше 30 символов');
        } else {
            $result = mysqli_query($con, "INSERT INTO News (`title`, `content`, `image`, `category_id` ) 
            VALUES ('$title', '$content', '$file', '$category_id')");
        }
        if ($result) {
            move_uploaded_file($file, "images/news/$file");
            echo checkError("Новость успешно создана!");
        } else {
            echo checkError("Произошла ошибка: " . mysqli_error($con));
        }
    } else {
        echo checkError("Все поля должны быть заполнены!");
    }
?>

</body>
</html>