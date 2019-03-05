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
    <form action="addConCon.php" method="post">
        所属分类：<select class="form-control" name="cid">
            <option value="0">一级分类</option>
            <?php
            include "../public/db.php";
            include "../libs/category.php";
            $obj=new tree();
            $obj->category(0,$db,"category",0,"-&nbsp;");
            echo $obj->str;
            ?>
        </select>
        内容标题：<input class="form-control" type="text" name="stitle"><br>
        内容描述：<input class="form-control" type="text" name="sintro"><br>
        内容：
        <script name="scon" id="editor" type="text/plain" style="width:100%;height:200px;">  </script>
        <br>
        图片：
        <div class="parent"></div>
        <input type="hidden" class="simg" name="simg"><br>
        价格：<input class="form-control" type="text" name="sprice"><br>
        库存：<input class="form-control" type="text" name="snum"><br>
        其他分类：
        <?php
            $sql="select * from position";
            $result=$db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            while($row=$result->fetch()){
        ?>
            <?php echo $row["posname"]?><input type="radio" name="posid" value="<?php echo $row['posid']?>">
        <?php
        }
        ?><br>
        <button class="btn btn-info" type="submit">添加</button>
    </form>
</div>
<script>
        var ue = UE.getEditor('editor');
    window.onload= function () {

        var upobj=new upload();
        upobj.selectFileStyle="display:inline-block;padding:6px 12px;border-radius:5px;background:orange;cursor:pointer;";
        upobj.selectBtnStyle="padding:4px 12px;border-radius:5px;background:#31b0d5;color:#fff";
        upobj.createView({parent:document.querySelector(".parent")});
        upobj.up("upload.php",function (e) {
            var str=e.join(";");
            $(".simg").val(str);
        })
    }
</script>
</body>
</html>