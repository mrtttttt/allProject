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
    <h3>修改内容</h3>
    <form action="editConCon.php" method="post">
        所属分类：<select class="form-control" name="cid">
            <option value="0">一级分类</option>
            <?php
            $sid = $_GET["sid"];
            include "../public/db.php";
            include "../libs/category.php";
            $obj=new tree();
            $obj->con(0,$db,"category","shows",0,"-&nbsp;",$sid);
            echo $obj->str;
            $sql="select * from shows where sid='{$sid}'";
            $result=$db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $row=$result->fetch();
            ?>
        </select>
        内容标题：<input class="form-control" type="text" value="<?php echo $row['stitle']?>" name="stitle"><br>
        内容描述：<input class="form-control" type="text" value="<?php echo $row['sintro']?>" name="sintro"><br>

        内容：
        <script name="scon" id="editor" type="text/plain" style="width:100%;height:200px;">  <?php echo $row['scon']?></script>
        <br>
        图片：
        <img src="<?php echo $row['simg']?>" alt="" width="100">
        <div class="parent"></div>
        <input type="hidden" class="simg" name="simg" value="<?php echo $row['simg']?>"><br>
        价格：<input class="form-control" type="text" name="sprice" value="<?php echo $row['sprice']?>"><br>
        库存：<input class="form-control" type="text" name="snum" value="<?php echo $row['snum']?>"><br>
        其他分类：
        <?php
        $sql2="select * from position";
        $result2=$db->query($sql2);
        $result2->setFetchMode(PDO::FETCH_ASSOC);
        while($row2=$result2->fetch()){
            if($row2["posid"]==$row["posid"]){
            ?>
            <?php echo $row2["posname"]?><input checked="checked" type="radio" name="posid" value="<?php echo $row2['posid']?>">
            <?php
        }else {
                ?>
                <?php echo $row2["posname"] ?>
                <input type="radio" name="posid" value="<?php echo $row2['posid'] ?>">
                <?php
            }}
        ?>

        <br>
        <input type="hidden" name="sid" value=<?php echo $sid?>>
        <button class="btn btn-info" type="submit">修改</button>
    </form>
</div>
<script>
    window.onload= function () {
        var ue = UE.getEditor('editor');
        var upobj=new upload();
        upobj.createView({parent:document.querySelector(".parent")});
        upobj.up("upload.php",function (e) {
            console.log(e)
            var str=e.join(";");
            $(".simg").val(str);
        })
    }
</script>
</body>
</html>