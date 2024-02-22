<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1520px;
            margin: 0 auto;
        }
        .nav {
            width: 100%;
            background-color: #262D33;
        }            
        .nav .container ul {
            display: flex;
            justify-content: space-between;
            height: 70px;
            align-items: center;
            list-style-type: none;
        }
        .item a {
            text-decoration: none;
            font-size: 22px;
            color: #fff;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
<header class="header">
<nav class="nav">
    <div class="container">
        <ul>
            <li class="item"><a href="#">Link</a></li>
            <li class="item"><a href="#">Link</a></li>
            <li class="item"><a href="#">Link</a></li>
            <li class="item"><a href="#">Link</a></li>
            <li class="item"><a href="#">Link</a></li>
            <li class="item"><a href="/">Вернуться назад</a></li>
        </ul>
    </div>
</nav>

</header>
</body>
</html>