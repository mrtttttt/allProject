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
    <script src="../static/js/jquery-3.2.1.js"></script>
    <script src="../static/js/upload.js"></script>
    <title>Document</title>
    <style>
        .img-box{
            width: 100px;height: 100px;border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h3>修改分类</h3>
    <form action="editCategoryCon.php" method="post">
        所属分类：<select class="form-control" name="pid">
            <option value="0">一级分类</option>
            <?php
            $cid = $_GET["cid"];
            include "../public/db.php";
            include "../libs/category.php";
            $obj=new tree();
            $obj->category(0,$db,"category",0,"-&nbsp;",$cid);
            echo $obj->str;
            $sql="select * from category where cid='{$cid}'";
            $result=$db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $row=$result->fetch();
            ?>
        </select>
        分类名称：<input class="form-control" value="<?php echo $row['cname']?>" type="text" name="cname"><br>
        分类英文名称：<input class="form-control" value="<?php echo $row['cenglish']?>" type="text" name="cenglish"><br>
        分类描述：<input class="form-control" value="<?php echo $row['cintro']?>" type="text" name="cintro"><br>
        图片<div class="img-box" style="background-image: url(<?php echo $row['cimg']?>);background-size: cover"></div>
        <div class="parent"></div>
        <input class="cimg" type="hidden" name="cimg">
        <input type="hidden" name="cid" value="<?php echo $cid?>">
        <button class="btn btn-info" type="submit">修改</button>
    </form>
</div>
<script>
    window.onload= function () {

        var upobj=new upload();
        upobj.createView({parent:document.querySelector(".parent")});
        upobj.up("upload.php",function (e) {
            var str=e.join(";");
            $(".cimg").val(str);
        })
    }
</script>
</body>
</html>