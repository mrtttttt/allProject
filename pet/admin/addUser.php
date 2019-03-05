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

<form action="addUserCon.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1">用户名</label>
        <input type="text" class="aname form-control" placeholder="text" name="aname">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">密码</label>
        <input type="text"  id="apass" class="form-control" name="apass" placeholder="pass">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">确认密码</label>
        <input type="text" class="form-control" name="apass1" placeholder="pass">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">昵称</label>
        <input type="text" class="form-control" placeholder="text" name="anicheng">
    </div>
    <div class="form-group parent">
        <label for="exampleInputEmail1">头像</label>

    </div>
    <input type="hidden" value="" name="aphoto">
    <input type="submit" class="btn btn-default" value="添加" >
</form>

<script>
    $(function () {
        $("form").validate({
            rules:{
                aname:{
                    required:true,
                    minlength:2,
                    remote:{
                        url:"checkRegis.php",
                        type:"get"
                    }
                },
                apass:{
                    required:true,
                    minlength:6,
                    maxlength:20
                },
                apass1:{
                    required:true,
                    minlength:6,
                    maxlength:20,
                    equalTo:"#apass"
                }
            },
            messages:{
                aname:{
                    required:"用户名不能为空",
                    minlength:"用户名长度不能少于2位",
                    remote:"用户名已存在"
                },
                apass:{
                    required:"密码不能为空",
                    minlength:"密码长度不能少于6位",
                    maxlength:"密码长度不能大于20位"
                },
                apass1:{
                    required:"密码不能为空",
                    minlength:"密码长度不能少于6位",
                    maxlength:"密码长度不能大于20位",
                    equalTo:"两次密码必须一致"
                }
            }
        })
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