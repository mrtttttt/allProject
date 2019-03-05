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
    <style>
        .table th,td{
            width: 15%;
        }
    </style>
</head>
<body>
<!--<div class="container">-->

    <table class="table table-hover">
        <tr>
            <th>内容标题</th>
            <th>描述</th>
            <th>内容</th>
            <th>图片</th>
            <th>价格</th>
            <th>库存</th>
            <th>所属分类名称</th>
            <th>其他分类</th>
            <th>操作</th>
        </tr>
        <?php
        include "../public/db.php";
        $sql="select * from shows";
        $result=$db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($row=$result->fetch()) {
            $sql2="select * from category where cid=".$row["cid"];
            $result2=$db->query($sql2);
            $result2->setFetchMode(PDO::FETCH_ASSOC);
            $row2=$result2->fetch();
            $cname=$row2["cname"];
            //其他分类名称
            $sql3="select * from position where posid=".$row["posid"];
            $result3=$db->query($sql3);
            $result3->setFetchMode(PDO::FETCH_ASSOC);
            $row3=$result3->fetch();
            $posname=$row3["posname"];
            ?>
            <tr>
                <td><?php echo $row["stitle"]?></td>
                <td><?php echo substr($row["sintro"],0,strpos($row["sintro"],"，")+3)?></td>
                <td><?php echo substr($row["scon"],0,strpos($row["scon"],"。")+3)?></td>
                <td><?php echo $row["simg"]?></td>
                <td><?php echo $row["sprice"]?></td>
                <td><?php echo $row["snum"]?></td>
                <td><?php echo $cname?></td>
                <td><?php echo $posname?></td>
                <td><a href='editCon.php?sid=<?php echo $row["sid"]?>' class='btn btn-info'>编辑</a><a href='delCon.php?sid=<?php echo $row["sid"]?>' class='btn btn-danger'>删除</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
<!--</div>-->
</body>
</html>