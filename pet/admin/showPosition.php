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
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $cssurl?>bootstrap.css">
    <script src="<?php echo $jsurl?>jquery-3.2.1.js"></script>
</head>
<body>
<table class="table table-bordered">
    <tr>
        <th>其他分类id</th>
        <th>其他分类名称</th>
        <th>操作</th>
    </tr>
    <?php
    include "../public/db.php";
    $sql="select * from position";
    $result = $db->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    while ($row=$result->fetch()){
        ?>
        <tr>
            <td><?php echo $row["posid"]?></td>
            <td><?php echo $row["posname"]?></td>
            <td class="last"><a href="editPosition.php?posid=<?php echo $row["posid"]?>" class="btn btn-info" style="margin-right: 30px">编辑</a><a href="delPosition.php?posid=<?php echo $row["posid"]?>" class="btn btn-danger">删除</a></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>