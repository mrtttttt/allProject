<?php
include "../public/header.php";
?>
<link rel="stylesheet" href="<?php echo $cssurl?>petType.css">
<link rel="stylesheet" href="<?php echo $cssurl?>index.css">
    <link rel="stylesheet" href="<?php echo $cssurl?>reset.css">
    <link rel="stylesheet" href="<?php echo $cssurl?>main.css">
<script src="<?php echo $jsurl?>jquery.wookmark.js"></script>

<?php
include "../public/db.php";
$sql2="select * from shows where posid=3";
$result2=$db->query($sql2);
$result2->setFetchMode(PDO::FETCH_ASSOC);
$row2=$result2->fetch();
$img= explode(';',$row2["simg"]);
?>
<section class="pet" style="background-image: url('../admin/<?php echo $img[0]?>')"></section>

<section class="hotdog hotPet">
    <main>
        <?php
        $sql3="select * from category where cid=".$_GET["cid"];
        $result3=$db->query($sql3);
        $result3->setFetchMode(PDO::FETCH_ASSOC);
        $row3=$result3->fetch();

        ?>
        <p><?php echo $row3["cname"]?></p>
        <div class="pUnder"></div>
        <ul class="hotUl">
            <li class="lineLi" cid="<?php echo $_GET['cid']?>" >ALL pet</li>
            <?php
            $sql="select * from category where pid=".$_GET["cid"];
            $result=$db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            while ($row=$result->fetch()){
                ?>
                    <li cid="<?php echo $row['cid']?>" >
                        <?php echo $row["cname"]?>
                    </li>
                <?php
            }
            ?>
        </ul>
    </main>

    <script src="<?php echo $jsurl?>petType.js"></script>
    <main id="main">
        <ul class="pz-body" id="tiles" >
            <?php
            include "../public/db.php";
            $sql="select * from category where pid=".$_GET["cid"];
            $result=$db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            while ($row=$result->fetch()){
                $sql1="select * from shows where cid=".$row["cid"];
                $result1=$db->query($sql1);
                $result1->setFetchMode(PDO::FETCH_ASSOC);
                while($row1=$result1->fetch()){
                    $imgarr=explode(";",$row1["simg"]);
                    if($row1["posid"]!=2){
                        ?>
                        <li>
                            <img src="../admin/<?php echo $imgarr[0]?>" width="200" alt="">
                            <div class="showA">
                                <a href="article.php?sid=<?php echo $row1['sid']?>">基本介绍</a>
                                <a href="details.php?sid=<?php echo $row1['sid']?>">交易页</a>
                            </div>
                        </li>
                        <?php
                    }
                }
            }
            ?>
        </ul>
    </main>
</section>
<?php
include "../public/footer.php";
?>