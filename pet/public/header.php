<?php
session_start();
$_SESSION["preUrl"]=strtolower(strchr($_SERVER["SERVER_PROTOCOL"],"/",true))."://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
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
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo $cssurl?>header.css">
    <link rel="stylesheet" href="<?php echo $cssurl?>contact.css">
    <script src="<?php echo $jsurl?>index.js"></script>
</head>
<body>
<header>
    <main>
        <div class="logo">
            <img src="../static/img/logo.png" alt="" />
        </div>
        <form action="" class="search">
            <input type="text" placeholder="请输入你想查找的内容" />
            <button type="submit" class="glyphicon glyphicon-search"></button>
        </form>
        <?php
        if(isset($_SESSION["user"])){
            ?>
            <div class="user user1">
                <p>用户<a href="personal.php?uid=<?php echo $_SESSION['uid']?>"><?php echo $_SESSION["uname"]?></a>已登陆</p>
            <p><a href="personal.php?uid=<?php echo $_SESSION['uid']?>">个人中心</a></p>
            <p><a href="logout.php">退出登录</a></p>
            </div>
        <?php
        }else{
            ?>
            <div class="login user1">
                <a href="register.php" class="registe">注册</a>
                <a href="login.php" class="join">登陆</a>
            </div>
        <?php
        }
        ?>
    </main>
</header>
<nav>
    <main>
        <ul class="navUl">
            <li><a href="index.php">首页</a></li>
            <?php
            include "../public/db.php";
            $sql="select * from category where pid=0 and isshow=0";
            $result=$db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            while($row=$result->fetch()){
                if($row["state"]==1){
                    $url="petType.php";
                }else{
                    $url="lists.php";
                }
                if($row["cname"]=="宠物品种"){
                    $url="petType.php";
                }else if($row["cname"]=="留言博客"){
                    $url="blog.php";
                }else if($row["cname"]=="加入我们"){
                    $url="joinUs.php";
                }
                ?>
                <li><a href="<?php echo $url?>?cid=<?php echo $row['cid']?>">
                        <?php echo $row["cname"]?>
                    </a></li>
                <?php
            }
            ?>
        </ul>
    </main>
</nav>
<section class="navList">
    <main>
        <ul>
            <li><a href="index.php">首页</a></li>
            <?php
            include "../public/db.php";
            $sql="select * from category where pid=0 and isshow=0";
            $result=$db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            while($row=$result->fetch()){
                if($row["state"]==1){
                    $url="petType.php";
                }else{
                    $url="lists.php";
                }
                if($row["cname"]=="宠物品种"){
                    $url="petType.php";
                }else if($row["cname"]=="留言博客"){
                    $url="blog.php";
                }else if($row["cname"]=="加入我们"){
                    $url="joinUs.php";
                }
                ?>
                <li><a href="<?php echo $url?>?cid=<?php echo $row['cid']?>">
                        <?php echo $row["cname"]?>
                    </a></li>
                <?php
            }
            ?>
        </ul>
        <?php
        if(isset($_SESSION["user"])){
            ?>
            <div class="user">
                <p>用户<a href="personal.php?uid=<?php echo $_SESSION['uid']?>"><?php echo $_SESSION["uname"]?></a>已登陆</p>
                <p><a href="personal.php?uid=<?php echo $_SESSION['uid']?>">个人中心</a></p>
                <p><a href="logout.php">退出登录</a></p>
            </div>
            <?php
        }else{
            ?>
            <div class="login">
                <a href="register.php" class="registe">注册</a>
                <a href="login.php" class="join">登陆</a>
            </div>
            <?php
        }
        ?>
    </main>
</section>