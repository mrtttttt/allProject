<?php
include "../public/check.php";
include "../public/path.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo $cssurl?>bootstrap.css">
    <title>Document</title>
<!--    <script src="http://localhost/php/cms/static/js/jquery-3.2.1.js"></script>-->
<!--    <script src="http://localhost/php/cms/static/js/upload.js"></script>-->
</head>
<body>
<div class="container">
    <form action="addPositionCon.php" method="post">
        其他分类名称：<input class="form-control" type="text" name="posname"><br>
        <button class="btn btn-info" type="submit">添加</button>
    </form>
</div>

</body>
</html>