<?php
include "../connect.php";

$id_new = isset($_GET['new'])?$_GET['new']:false;
$query_delete = "DELETE FROM News WHERE news_id='$id_new'";

$result = mysqli_query($con, $query_delete);

if($result) {
    echo "<script>alert('Данные удалены!');
        location.href='index.php';
    </script>";
} else {
    echo "<script>alert('Данные не полуичлось удалить.');
        location.href='index.php';
    </script>";
}
?>