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
    <script src="<?php echo $jsurl?>jquery-3.2.1.js"></script>
    <script src="<?php echo $jsurl?>upload.js"></script>

    <script src="<?php echo $editurl?>ueditor.config.js"></script>
    <script src="<?php echo $editurl?>ueditor.all.min.js"></script>
    <script src="<?php echo $editurl?>lang/zh-cn/zh-cn.js"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
    <form action="addJobCon.php" method="post">
        职位：<input class="form-control" type="text" name="jname"><br>
        招聘人数：<input class="form-control" type="text" name="jnum"><br>
        工作地点：<input class="form-control" type="text" name="jplace"><br>
        薪资：<input class="form-control" type="text" name="jprice"><br>
        职位介绍：<textarea name="jintro" class="form-control" rows="3"></textarea><br>
        职位要求：<textarea name="jrequired" class="form-control" rows="3"></textarea><br>
        <button class="btn btn-info" type="submit">添加</button>
    </form>
</body>
</html>