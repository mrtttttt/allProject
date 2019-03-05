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
    <style>
        *{margin: 0;padding: 0;
            list-style:none;}
        html,body{
            height: 100%;
        }
        .container.head{
            border: 1px solid #ccc;height: 15%;
            position: relative;
        }
        .container{
            height: 80%;
        }
        .row{
            border: 1px solid #ccc;border-top: none;
            height: 100%;
        }
        .left{
            border-right: 1px solid #ccc;height: 100%;
        }
        .right{
            height: 100%;
        }
        .left>ul>li{
            line-height: 35px;
        }
        .item{
            line-height: 30px;padding-left: 30px;
        }
        iframe{
            width: 100%;height: 100%;
        }
        h1{
            float: left;width: 89%;
        }
        .aphoto{
            width: 50px;height: 50px;border-radius: 50%;display: block;overflow: hidden;margin-top: 1.5%;float: right;margin-right: 70px;
        }
        .anicheng{
            opacity: 0;transition: .5s;
            font-size: 26px;position: absolute; top: 22%;right: 4%;
        }
        .aphoto:hover+.anicheng{
            opacity: 1;
        }
    </style>
</head>
<body>
<?php
    $aid = $_SESSION["aid"];
    include "../public/db.php";
    $sql = "select * from admin where aid='{$aid}'";
    $result=$db->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $row=$result->fetch();
    $url=explode(";",$row["aphoto"]);
    $a=count($url)-1;
    $num=mt_rand(0,$a);
?>
    <div class="container head">
<!--        <h1>--><?php //echo file_get_contents("title.txt")?><!--</h1>-->
        <h1>欢迎用户<?php echo $row["aname"] ?>来到管理平台</h1>
        <span class="aphoto" style="background-image: url('<?php echo $url[$num] ?>');background-size: cover"></span>
        <span class="anicheng"><?php echo $row["anicheng"]?></span>
        <a href="logout.php" style="clear: both">安全退出</a>
        <a href="../index/index.php" style="clear: both" target="_blank">回到首页</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-4 col-sm-3 left">
                <ul class="list-unstyled">
                    <li>
                        <span class="caret"></span>&nbsp;管理员管理
                        <ul class="item">
                            <li><a href="showUser.php" target="right">查看管理员</a></li>
                            <li><a href="addUser.php" target="right">添加管理员</a></li>
                        </ul>
                    </li>
                    <li>
                        <span class="caret"></span>&nbsp;分类管理
                        <ul class="item">
                            <li><a href="showCategory.php" target="right">查看分类</a></li>
                            <li><a href="addCategory.php" target="right">添加分类</a></li>
                        </ul>
                    </li>
                    <li>
                        <span class="caret"></span>&nbsp;用户管理
                        <ul class="item">
                            <li><a href="showConCate.php" target="right">查看内容分类</a></li>
                            <li><a href="showCon.php" target="right">查看内容</a></li>
                            <li><a href="addCon.php" target="right">添加内容</a></li>
                        </ul>
                    </li>
                    <li>
                        <span class="caret"></span>&nbsp;其他分类管理
                        <ul class="item">
                            <li><a href="showPosition.php" target="right">查看其他分类</a></li>
                            <li><a href="addPosition.php" target="right">添加其他分类</a></li>
                        </ul>
                    </li>
                    <li>
                        <span class="caret"></span>&nbsp;招聘职位管理
                        <ul class="item">
                            <li><a href="showJob.php" target="right">查看招聘职位</a></li>
                            <li><a href="addJob.php" target="right">添加招聘职位</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-xs-8 col-sm-9 right">
                <iframe frameborder="0" name="right"></iframe>
            </div>
        </div>
    </div>
</body>
</html>