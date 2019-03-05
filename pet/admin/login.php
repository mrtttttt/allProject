<?php
session_start();
if(isset($_SESSION["login"])){
    /*$tip="已登录";
    $url="index.php";
    include "../public/message.php";*/
    echo "<script>alert('已登陆');location.href='index.php'</script>";
    exit;
}
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
    <style>
        .container{
            width: 50%;
            height: 300px;margin: 150px auto;border: 1px solid #ccc;border-radius: 8px;
            padding: 0 40px 0 0;
        }
        h3{
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<div class="container">
<h3>请登录</h3>
<form class="form-horizontal" action="checkLogin.php" method="post">
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">用户</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="username" placeholder="user">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">登陆</button>
            <br>
        </div>
    </div>
</form>
</div>
<script>
    $(function () {
        $("form").validate({
            rules:{
                username:{
                    required:true,
//                    minlength:3
                },
                password:{
                    required:true
                }
            },
            messages:{
                username:{
                    required:"用户名不能为空",
//                    minlength:"密码长度不能少于1位"
                },
                password:{
                    required:"密码不能为空"
                }
            }
        })
    })
</script>
</body>
</html>