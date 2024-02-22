<?php
require "connect.php";
$items = mysqli_query($con, "SELECT * FROM Categories");
$all = mysqli_fetch_all($items);
$sort = isset($_GET["sort"])?$_GET["sort"]:"";
$search = isset($_GET["search"])?$_GET["search"]:"";
$category = isset($_GET["category"])?$_GET["category"]:"";
?>
<head>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<header class="header">
    <div class="container">
        <form action="" method="GET">
            <nav class="nav">
                <div class="sections">
                    <label for="sections_select">BLOB</label>
                    <select id="sections_select">
                        <option value="sections">Sections</option>
                    </select>
                </div>
                <div class="search">
                    <label for="search"></label>
                    <input type="text" id="search" name="search" placeholder="Search" value="<?php if ($search) echo $search ?>">
                </div>
                <div class="sign-in">
                    <button class="sign_btn"><a href="Auth_Reg/auth.php">Sign-in</a></button>
                </div>
                <input type="hidden" name="category" value="<?= $category ?>">
                <input type="hidden" name="sort" value="<?= $sort; ?>">
            </nav>
        </form>
    </div>
    <h1 class='main_h1' onclick="location.href='/'">Пингвины</h1>  
    <div class="links">
        <ul class="container links">
        <?php
            foreach ($all as $elem) {
                echo "<li><a href='?category=$elem[0]&sort=$sort'>" . $elem[1] . "</a></li>";
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