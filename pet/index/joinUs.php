<?php
include "../public/header.php";
?>
    <link rel="stylesheet" href="<?php echo $cssurl?>joinUs.css">
    <script src="<?php echo $jsurl?>join.js"></script>
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
<section class="joinUs">
    <main>
        <div class="jHead">
            <h2>招聘列表</h2>
        </div>
        <ul class="headUl">
            <li class="col-md-4">职位</li>
            <li class="col-md-2">招聘人数</li>
            <li class="col-md-2">工作地点</li>
            <li class="col-md-2">薪资</li>
            <li class="col-md-2">操作</li>
        </ul>
        <ul class="itemUl">
            <?php
            $sql="select * from job";
            $result=$db->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            while ($row=$result->fetch()){

            ?>
            <li>
                <div class="button">
                    <div class="col-md-4"><?php echo $row["jname"]?></div>
                    <div class="col-md-2"><?php echo $row["jnum"]?></div>
                    <div class="col-md-2"><?php echo $row["jplace"]?></div>
                    <div class="col-md-2"><?php echo $row["jprice"]?></div>
                    <div class="col-md-2"><div class="apply">立即申请</div></div>
                </div>
                <div class="introduce">
                    <h3>职位描述</h3>
                    <p><?php echo $row["jintro"]?></p>
                    <hr />
                    <h3>任职要求</h3>
                    <p><?php echo $row["jrequired"]?></p>
                    <div class="apply">立即申请</div>
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