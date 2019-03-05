<?php
session_start();
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
    <script src="<?php echo $jsurl?>jquery.validate.js"></script>
    <title>Login</title>
    <style>
        body{
            background:#4D96DB;
        }
        .message{
            text-align: center;margin: 30px;
        }
        .login{
            width: 50%;height: 483px;position: absolute;
            top:0;left: 0;bottom: 0;right: 0;margin: auto;
            padding: 50px 40px;background: #fff;box-sizing: border-box;
            border-radius: 5px;
        }
        .error{
            color: red;
        }
        .code{
            width: 100%;height: 50px;
            overflow: hidden;
        }
        .code iframe{
            height: 40px;
            border: 1px solid #ccc;border-radius: 3px;
        }
    </style>
</head>
<body>
<section class="login">
    <div class="message">
        <h2>会员登陆</h2>
    </div>
    <form class="form-horizontal" action="checkLogin.php" method="post">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputEmail3" placeholder="username" name="username">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
            <div class="col-sm-10">
                <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group code">
            <label class="col-sm-2 control-label">验证码</label>
            <div class="col-sm-2">
                <input  class="form-control" name="code" type="text">
            </div>
            <iframe class="col-sm-2" src="../public/code.php" frameborder="0"></iframe>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">登陆</button>
            </div>
        </div>
    </form>
    <div class="message">
        <p>没有账号?去<a href="register.php">注册</a></p>
    </div>
</section>
<script>
    $(function () {
        $("form").validate({
            rules:{
                username:{
                    required:true
                },
                password:{
                    required:true
                }
            },
            messages:{
                username:{
                    required:"用户名不能为空"
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


