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
<div class="container">

    <table class="table table-hover">
        <tr>
            <th>职位</th>
            <th>招聘人数</th>
            <th>工作地点</th>
            <th>薪资</th>
            <th>职位介绍</th>
            <th>职位要求</th>
            <th>操作</th>
        </tr>
        <?php
        include "../public/db.php";
        $sql="select * from job";
        $result=$db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($row=$result->fetch()) {
            ?>
            <tr>
                <td><?php echo $row["jname"]?></td>
                <td><?php echo $row["jnum"]?></td>
                <td><?php echo $row["jplace"]?></td>
                <td><?php echo $row["jprice"]?></td>
                <td><?php echo $row["jintro"]?></td>
                <td><?php echo $row["jrequired"]?></td>
               <!-- <td><?php /*echo substr($row["jintro"],0,strpos($row["sintro"],"，")+3)*/?></td>
                <td><?php /*echo substr($row["jrequired"],0,strpos($row["scon"],"。")+3)*/?></td>-->

                <td><a href='editJob.php?jid=<?php echo $row["jid"]?>' class='btn btn-info'>编辑</a><a href='delJob.php?jid=<?php echo $row["jid"]?>' class='btn btn-danger'>删除</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>