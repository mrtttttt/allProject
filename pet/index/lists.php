<?php
include "../public/header.php";
?>
<link rel="stylesheet" href="<?php echo $cssurl?>petSupplies.css">
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

<section class="petSupplies">
			<main>
                <?php
                $sql3="select * from category where cid=".$_GET["cid"];
                $result3=$db->query($sql3);
                $result3->setFetchMode(PDO::FETCH_ASSOC);
                $row3=$result3->fetch();
                ?>
				<p id="titleHead"><?php echo $row3["cname"]?></p>
                <ul class="petSul">
                <?php
                include "../public/db.php";
                $sql="select * from shows where cid=".$_GET["cid"];
                $result=$db->query($sql);
                $result->setFetchMode(PDO::FETCH_ASSOC);
                while ($row=$result->fetch()){
                    $imgarr=explode(";",$row["simg"]);
                    ?>
                    <li>
                        <a href="details.php?sid=<?php echo $row['sid']?>" class="img-box"><img src="../admin/<?php echo $imgarr[0]?>" alt="" /></a>
                        <div class="pettext">
                            <p><a href="details.php?sid=<?php echo $row['sid']?>"><?php echo $row["stitle"]?></a></p>
                            <p>￥<span><?php echo $row["sprice"]?></span></p>
                            <a href="details.php?sid=<?php echo $row['sid']?>">购买</a>
                        </div>
                    </li>
                    <?php
                }
                ?>
				</ul>
			</main>
			
		</section>
<?php
include "../public/footer.php";
?>
