<?php
include "../public/header.php";
?>
<link rel="stylesheet" href="<?php echo $cssurl?>index.css">
<script src="<?php echo $jsurl?>jquery-3.2.1.js"></script>
<script src="<?php echo $jsurl?>dog.js"></script>
<section class="banner">
    <ul class="banner-box">
        <?php
        include "../public/db.php";
        $sql="select * from shows where posid=2";
        $result=$db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($row=$result->fetch()) {
            ?>
            <li><a href="article.php?sid=<?php echo $row['sid']?>" style="background-image: url('../admin/<?php echo $row["simg"]?>');background-size: cover"></a></li>
            <?php
        }
        ?>
    </ul>
</section>
<?php
include "../public/db.php";
$sql0="select * from category where pid=0 and isshow=0";
$result0=$db->query($sql0);
$result0->setFetchMode(PDO::FETCH_ASSOC);
$row0=$result0->fetchAll();
?>
<section class="hotdog">
    <main>
        <div class="hd-head">
            <p><span><?php echo $row0[0]["cname"]?>·</span><?php echo $row0[0]["cenglish"]?></p>
            <hr color="#EFEFEF" size="1" />
            <p><?php echo $row0[0]["cintro"]?></p>
        </div>
        <div class="hd-body">
            <?php
            $sql1="select * from shows where posid=1";
            $result1=$db->query($sql1);
            $result1->setFetchMode(PDO::FETCH_ASSOC);
            while ($row1=$result1->fetch()) {
                $imgarr=explode(";",$row1["simg"]);
                ?>
                <div>
                    <img src="../admin/<?php echo $imgarr[0]?>" alt="" />
                    <a href="article.php?sid=<?php echo $row1['sid']?>" class="hd-hid" style="color: #fff;text-decoration: none">
                        <p><?php echo $row1['stitle']?></p>
                        <span><?php echo $row1['sintro']?></span>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
    </main>
</section>
<section class="hotdog">
    <main>
        <div class="hd-head">
            <p><span><?php echo $row0[1]["cname"]?>·</span><?php echo $row0[1]["cenglish"]?></p>
            <hr color="#EFEFEF" size="1" />
            <p>任何需求都是您对宠物的爱</p>
        </div>
        <div class="hd-body hd-body1">
            <?php
            $sql2="select * from shows where posid=4 limit 0,5";
            $result2=$db->query($sql2);
            $result2->setFetchMode(PDO::FETCH_ASSOC);
            while ($row2=$result2->fetch()) {
                $imgarr2=explode(";",$row2["simg"]);
                ?>
                <a href="details.php?sid=<?php echo $row2['sid']?>">
                    <div class="hd-img">
                        <img src="../admin/<?php echo $imgarr2[0]?>" alt="" />
                    </div>
                    <div class="info"><p><?php echo $row2['stitle']?></p>more information</div>
                </a>
                <?php
            }
            ?>
        </div>
    </main>
</section>
<section class="hotdog">
    <main>
        <div class="hd-head">
            <p><span><?php echo $row0[2]["cname"]?>·</span><?php echo $row0[2]["cenglish"]?></p>
            <hr color="#EFEFEF" size="1" />
            <p><?php echo $row0[3]["cintro"]?></p>
        </div>
        <div class="hd-body">
            <ul>
                <?php
                $sql3="select * from category where pid=".$row0[2]["cid"];
                $result3=$db->query($sql3);
                $result3->setFetchMode(PDO::FETCH_ASSOC);
                $i=1;
                while($row3=$result3->fetch()){
                    $sql2="select * from shows where cid=".$row3["cid"]." limit 0,2";
                    $result2=$db->query($sql2);
                    $result2->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row2=$result2->fetch()) {
                        $i+=1;
                        if($i%2){
                            if($row2["uid"]==0){
                            ?>
                            <li>
                                <a class="ac-img" href="article.php?sid=<?php echo $row2['sid']?>"><img src="../admin/<?php echo $row2['simg']?>" alt=""></a>
                                <p><a href="article.php?sid=<?php echo $row2['sid']?>"><?php echo $row2['stitle']?></a>2016-05-18</p>
                                <span><?php echo $row2['sintro'] ?></span>
                            </li>
                            <?php
                        } else{
                                ?>
                                <li>
                                    <a class="ac-img" href="article.php?sid=<?php echo $row2['sid']?>"><img src="<?php echo $row2['simg']?>" alt=""></a>
                                    <p><a href="article.php?sid=<?php echo $row2['sid']?>"><?php echo $row2['stitle']?></a>2016-05-18</p>
                                    <span><?php echo $row2['sintro'] ?></span>
                                </li>
                                <?php

                            }} else{

                            if($row2["uid"]==0){
                            ?>
                            <li>
                                <a class="ac-img" href="article.php?sid=<?php echo $row2['sid']?>"><img src="../admin/<?php echo $row2['simg']?>" alt=""></a>
                                <p><a href="article.php?sid=<?php echo $row2['sid']?>"><?php echo $row2['stitle']?></a>2016-05-18</p>
                                <span><?php echo $row2['sintro'] ?></span>

                            </li>
                            <?php
                        }else{
                                ?>
                                <li>
                                    <a class="ac-img" href="article.php?sid=<?php echo $row2['sid']?>"><img src="<?php echo $row2['simg']?>" alt=""></a>
                                    <p><a href="article.php?sid=<?php echo $row2['sid']?>"><?php echo $row2['stitle']?></a>2016-05-18</p>
                                    <span><?php echo $row2['sintro'] ?></span>

                                </li>
                                <?php
                            }}}}
                    ?>


            </ul>
        </div>
    </main>
</section>
<?php
include "../public/footer.php";
?>