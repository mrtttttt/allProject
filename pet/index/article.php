<?php
include "../public/header.php";
?>
<link rel="stylesheet" href="<?php echo $cssurl?>article.css">
<?php
include "../public/db.php";
$sql2="select * from shows where posid=3";
$result2=$db->query($sql2);
$result2->setFetchMode(PDO::FETCH_ASSOC);
$row2=$result2->fetch();
$img= explode(';',$row2["simg"]);

?>
<section class="pet" style="background-image: url('../admin/<?php echo $img[1]?>')"></section>
		
		<section class="article">
			<main>
                <?php
                include "../public/db.php";
                $sql="select * from shows where sid=".$_GET["sid"];
                $result=$db->query($sql);
                $result->setFetchMode(PDO::FETCH_ASSOC);
                $row=$result->fetch();?>
				<p><?php echo $row["stitle"]?></p>
				<ul class="share">
					<li>分享到:</li>
					<li><a href="">微信</a></li>
					<li><a href="">复制网址</a></li>
					<li><a href="">腾讯微博</a></li>
					<li><a href="">新浪微博</a></li>
					<li><a href="">QQ空间</a></li>
					<li><a href="">开心网</a></li>
					<li><a href="">人人网</a></li>
					<li><a href="">豆瓣网</a></li>
					<li><a href="">网易微博</a></li>
					<li><a href="">百度贴吧</a></li>
				</ul>
                <div class="scon"><?php echo $row["scon"]?></div>
                <?php
                $nextSid=$_GET["sid"]+1;
                $sql2="select * from shows where sid=".$nextSid;
                $result2=$db->query($sql2);
                if($result2->rowCount()){
                    $result2->setFetchMode(PDO::FETCH_ASSOC);
                    $row2=$result2->fetch();
                    if($row2["posid"]==$row["posid"]){
                        ?>
                        <p><b>下一篇:</b><a href="article.php?sid=<?php echo $row2["sid"]?>">
                                <?php echo $row2["stitle"]?>
                            </a></p>
                        <?php
                    } else{
                    ?>
                    <p><b>下一篇:</b><a href="javascript:;">没有了</a></p>
                <?php }}?>
			</main>
		</section>
<section class="message">
    <main>
        <h3>留言区：</h3>
        <div class="container">
            <form action="addMessage.php" class="messageForm" method="post">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">留言主题</span>
                    <input type="text" class="title form-control" placeholder="title" aria-describedby="basic-addon1" name="mtitle">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" >留言内容</span>
                    <textarea name="mcon" class="textarea form-control" aria-describedby="basic-addon1" maxlength="200" rows="4"></textarea>
                </div>
                <input type="hidden" name="uid1" value="<?php echo isset($_SESSION['uid'])?$_SESSION['uid']:0?>">
                <input type="hidden" name="uid2" value="<?php echo $row['uid']?>">
                <input type="hidden" name="sid" value="<?php echo $row['sid']?>">
                <div class="more">还可输入<span>200</span>个字</div>
                <button class="btn btn-info" type="submit">提交</button>
            </form>
        </div>
        <div class="container">
            <ul class="messagecon">
                <?php
                $sql4="select user.uname,message.* from user,message where user.uid=message.uid1 and sid=".$_GET["sid"];
                $result4=$db->query($sql4);
                $result4->setFetchMode(PDO::FETCH_ASSOC);
                while ($row4=$result4->fetch()){
                    ?>
                    <li>
                        <h4><b><?php echo $row4["uname"]?>:</b></h4>
                        <span><?php echo $row4["mtitle"]?></span>
                        <span class="time"><?php echo $row4["mtime"]?></span><br>
                        <p><?php echo $row4["mcon"]?></p>
                        <?php
                        if(isset($_SESSION["uid"])){
                            if($row4["uid1"]==$_SESSION["uid"]){
                                ?>
                                <a href="delMessage.php?mid=<?php echo $row4['mid']?>">删除</a>
                                <?php
                            }
                        }
                            ?>


                    </li>
                    <?php
                }
                ?>

            </ul>
        </div>
    </main>
</section>
    <script>
        $(function () {
            $(".textarea").keyup(function () {
                let maxL=$(".textarea").attr("maxlength");
                let strL=$(this).val().length;
                let num=maxL-strL;
                if(num<=0){
                    num=0;
                }else if(num<=15){
                    $(".more span").css("color","red")
                }
                $(".more span").html(num);
            })
        })
    </script>
<?php
include "../public/footer.php";
?>