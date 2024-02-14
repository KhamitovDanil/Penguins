<head>
    <link rel="stylesheet" href="css/style.css">
</head>
<header class="header">
    <h1 class='main_h1' onclick="location.href='/'">Пингвины</h1>  
    <div class="links">
        <ul class="container links">
        <?php
            require "connect.php";
            $items = mysqli_query($con, "SELECT * FROM Categories");
            $all = mysqli_fetch_all($items);
            foreach ($all as $elem) {
                echo "<li><a href='/?category=$elem[0]' >" . $elem[1] . "</a></li>";
            }
        ?>
        </ul>
    </div>
</header>