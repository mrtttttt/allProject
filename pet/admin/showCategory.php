<?php
include "../public/check.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <title>Document</title>
    <style>

    </style>
</head>
<body>
<div class="container">
    <?php
    include "../public/db.php";
    include "../libs/category.php";
    $obj=new tree();
    $obj->showCate(0,$db,"category","");
    echo $obj->ul;
    ?>
</div>
</body>
</html>