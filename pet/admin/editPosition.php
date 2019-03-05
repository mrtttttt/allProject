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
</head>
<body>
<div class="container">
    <form action="editPositionCon.php" method="post">
        <?php
        include "../public/db.php";
        $sql="select * from position where posid=".$_GET["posid"];
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row=$result->fetch();
            ?>
        其他分类ID：<input name="posid" class="form-control" type="text" value="<?php echo $row['posid']?>" readonly="readonly">
        其他分类名称：<input class="form-control" value="<?php echo $row['posname']?>" type="text" name="posname"><br>
        <button class="btn btn-info" type="submit">修改</button>
    </form>
</div>

</body>
</html>