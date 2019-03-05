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
    <title>Document</title>
    <script src="../static/js/jquery-3.2.1.js"></script>
    <script src="../static/js/upload.js"></script>
</head>
<body>
<div class="container">
<form action="addCategoryCon.php" method="post">
    所属分类：<select class=" select form-control" name="pid">
        <option value="0">一级分类</option>
        <?php
            include "../public/db.php";
            include "../libs/category.php";
            $obj=new tree();
            $obj->category(0,$db,"category",0,"-&nbsp;");
            echo $obj->str;
        ?>
    </select>
    分类名称：<input class="form-control" type="text" name="cname"><br>
    分类英文名称：<input class="form-control" type="text" name="cenglish"><br>
    分类描述：<input class="form-control" type="text" name="cintro"><br>
    <div class="parent"></div>
    <input class="cimg" type="hidden" name="cimg">
    是否显示到主导航:
    显示<input type="radio" name="isshow" value="0">
    不显示<input type="radio" name="isshow" value="1"><br>
    <button class="btn btn-info" type="submit">添加</button>
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

        $(".select").blur(function () {
            var val=$(".select").val();
            if(val!="0"){
                $("input[type=radio]").attr("disabled","disabled")
            }
        })

    }
</script>
</body>
</html>
<script>
    /**
     *
     <?php
     include "../public/db.php";
     $sql="select * from category";
     $result=$db->query($sql);
     $result->setFetchMode(PDO::FETCH_ASSOC);
     while($row=$result->fetch()){
     ?>
     <option value="<?php echo $row["cid"]?>">
     <?php echo $row["cname"]?>
     </option>
     <?php
     }
     ?>
     */
</script>