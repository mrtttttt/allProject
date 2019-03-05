<?php
include "../public/header.php";
?>
<link rel="stylesheet" href="<?php echo $cssurl?>details.css">
<script src="<?php echo $jsurl?>details.js"></script>
<?php
include "../public/db.php";
$sql2="select * from shows where posid=3";
$result2=$db->query($sql2);
$result2->setFetchMode(PDO::FETCH_ASSOC);
$row2=$result2->fetch();
$img= explode(';',$row2["simg"]);
$a=count($img)-1;
$num=mt_rand(0,$a);
?>
<section class="pet" style="background-image: url('../admin/<?php echo $img[$num]?>')"></section>
<?php
$sid=$_GET["sid"];
$sql="select * from shows where sid=".$sid;
$result=$db->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
$row=$result->fetch();
$imgArr=explode(";",$row["simg"]);
?>
<section class="details">
    <main>
        <div class="showShop">
            <div class="bigShop">
                <?php
                    for ($i=0;$i<count($imgArr);$i++){
                        ?>
                        <img src="../admin/<?php echo $imgArr[$i]?>" alt="">
                        <?php
                }
                ?>
                <div class="btnl glyphicon glyphicon-menu-left"></div>
                <div class="btnr glyphicon glyphicon-menu-right"></div>
            </div>
            <div class="smallShop">
                <?php
                for ($i=0;$i<count($imgArr);$i++){
                    ?>
                    <div><img src="../admin/<?php echo $imgArr[$i]?>" alt=""></div>
                    <?php
                }
                ?>
            </div>

        </div>
        <div class="shopDetail">
            <h3><?php echo $row["stitle"]?></h3>
            <p><?php echo $row["sintro"]?></p>
            <div class="price">单价：<span><?php echo $row["sprice"]?></span></div>
            <!--<div>
                大小:
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-default">小</button>
                    <button type="button" class="btn btn-default">中</button>
                    <button type="button" class="btn btn-default">大</button>
                </div>
            </div>-->
            <div class="num">
                数量：
                <button class="btn btn-default glyphicon glyphicon-menu-left"></button>
                <input type="text" value="1">
                <button class="btn btn-default glyphicon glyphicon-menu-right"></button>
            </div>
            <div class="price priceAll">总价：<span><?php echo $row["sprice"]?></span></div>
            <div class="hadShop">
                库存 <span style="color: orangered"><?php echo $row["snum"]?> </span>件
            </div>
            <button class="buy btn btn-default">立即购买</button>
            <button class="willBuy btn btn-info">加入购物车</button>
        </div>
        <div class="detailsAll">
            <h3>详细信息</h3>
            <div><?php echo $row["scon"]?></div>
        </div>
        <div class="tuijian">
            <?php
            for ($i=0;$i<count($imgArr);$i++){
                ?>
                <img src="../admin/<?php echo $imgArr[$i]?>" alt="">
                <?php
            }
            ?>
            <div class="checklogin" style="display: none" login="<?php echo isset($_SESSION['user'])?$_SESSION['user']:'no' ?>"></div>
            <div class="btnl glyphicon glyphicon-menu-left"></div>
            <div class="btnr glyphicon glyphicon-menu-right"></div>
        </div>
    </main>
</section>
<?php
include "../public/footer.php";
?>
