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
    <script src="../static/js/jquery.validate.js"></script>
    <script src="../static/js/upload.js"></script>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
<?php
    $aid=$_GET["aid"];
    include "../public/db.php";
    $sql = "select * from admin where aid='{$aid}'";
    $result=$db->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $row=$result->fetch();
    $url=explode(";",$row["aphoto"]);
    $num=mt_rand(0,count($url)-1);
?>
<form action="editUserCon.php?aid=<?php echo $aid ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1">用户名</label>
        <input type="text" value="<?php echo $row['aname']?>" class="aname form-control" placeholder="text" name="aname">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">密码</label>
        <input type="text"  id="apass" class="form-control" name="apass" placeholder="pass">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">昵称</label>
        <input type="text" value="<?php echo $row['anicheng']?>" class="form-control" placeholder="text" name="anicheng">
    </div>
    <div class="form-group parent">
        <label for="exampleInputEmail1">头像</label>
        <img src="<?php echo $url[$num]?>" alt="" width="50">
    </div>
    <input type="hidden" value="<?php echo $row['aphoto']?>" name="aphoto">
    <input type="submit" class="btn btn-default" value="提交修改" >
</form>

<script>
    $(function () {
        var upobj=new upload();
        upobj.createView({parent:document.querySelector(".parent")});
        upobj.up("upload.php",function (e) {
            var str=e.join(";");
            $(":hidden").val(str);
        })
    })

</script>
</body>
</html>