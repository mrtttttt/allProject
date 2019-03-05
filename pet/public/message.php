<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="http://localhost/php/ajaxTable/js/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="http://localhost/php/ajaxTable/css/base.css">
    <style>
        .tip{
            width: 500px;
            height:300px;border: 1px solid #ccc;
            padding:30px;box-sizing: border-box;border-radius: 5px;text-align: center;
        }
        .title{
            font-weight: bold;
            font-size: 20px;
            line-height: 35px;
            text-align: center;
            margin-bottom: 50px;
        }
        .content{
            line-height: 35px;
        }
    </style>
</head>
<body>
    <div class="tip fix_mid">
        <div class="title"><?php echo $tip?></div>
        <div class="content">
            <span>3</span>秒后跳转登陆页面 <br>
            若未跳转，请点击 <a href="<?php echo $url?>">这里</a>
        </div>
    </div>
    <script>
        $(function () {
            var time=3;
            setInterval(function () {
                time--;
                if(time<0){
                    location.href="<?php echo $url?>";
                }else{
                    $("span").html(time);
                }
            },1000)
        })
    </script>
</body>
</html>