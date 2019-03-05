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
    <title>Document</title>
    <link rel="stylesheet" href="../static/css/bootstrap.css">
    <script src="../static/js/jquery-3.2.1.js"></script>
</head>
<body>
    <table class="table table-bordered">
        <tr>
            <th>用户名</th>
            <th>昵称</th>
            <th>头像</th>
            <th>操作</th>
        </tr>
        <?php
            include "../public/db.php";
            $sql="select * from admin";
            $result = $db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            while ($row=$result->fetch()){
                $url=explode(";",$row["aphoto"]);
                $a=count($url)-1;
                $num=mt_rand(0,$a);
                ?>
                <tr>
                    <td><?php echo $row["aname"]?></td>
                    <td><?php echo $row["anicheng"]?></td>
                    <td><img src="<?php echo $url[$num]?>" alt="" width="50" height="50"></td>
                    <td class="last"><a href="editUser.php?aid=<?php echo $row["aid"]?>" class="btn btn-info" style="margin-right: 30px">编辑</a><a href="delUser.php?aid=<?php echo $row["aid"]?>" class="btn btn-danger">删除</a></td>
                </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>