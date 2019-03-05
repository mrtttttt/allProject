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
    <?php
    $jid=$_GET["jid"];
    include "../public/db.php";
    $sql="select * from job where jid=".$jid;
    $result=$db->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $row=$result->fetch();
    ?>
    <form action="editJobCon.php" method="post">
        职位：<input class="form-control" type="text" name="jname" value="<?php echo $row['jname']?>"><br>
        招聘人数：<input  value="<?php echo $row['jnum']?>" class="form-control" type="text" name="jnum"><br>
        工作地点：<input  value="<?php echo $row['jplace']?>" class="form-control" type="text" name="jplace"><br>
        薪资：<input value="<?php echo $row['jprice']?>" class="form-control" type="text" name="jprice"><br>
        职位介绍：<textarea  name="jintro" class="form-control" rows="3"><?php echo $row['jintro']?></textarea><br>
        职位要求：<textarea  name="jrequired" class="form-control" rows="3"><?php echo $row['jrequired']?></textarea><br>
        <input type="hidden" name="jid" value="<?php echo $row['jid']?>">
        <button class="btn btn-info" type="submit">修改</button>
    </form>
</body>
</html>