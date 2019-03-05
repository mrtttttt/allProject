<?php
include "../public/header.php";
?>
    <link rel="stylesheet" href="<?php echo $cssurl?>blog.css">
    <script src="<?php echo $jsurl?>petType.js"></script>
    <script src="<?php echo $jsurl?>blog.js"></script>
    <script src="<?php echo $jsurl?>jquery-3.2.1.js"></script>
    <script src="<?php echo $jsurl?>upload.js"></script>
    <script src="<?php echo $editurl?>ueditor.config.js"></script>
    <script src="<?php echo $editurl?>ueditor.all.min.js"></script>
    <script src="<?php echo $editurl?>lang/zh-cn/zh-cn.js"></script>
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
<section class="blog">
    <main  class="showBlog">
        <div class="blogBox">
            <ul class="nav nav-tabs">
                <li role="presentation" class="active" cid="4"><a href="javascript: ;">所有博客</a></li>
                <li role="presentation"><a href="javascript: ;">新建博客</a></li>
                <li role="presentation"><a href="javascript: ;">我的博客</a></li>
            </ul>
            <div class="checklogin" style="display: none" login="<?php echo isset($_SESSION['user'])?$_SESSION['user']:'no' ?>"></div>
            <form class="newBlog" action="addBlogCon.php" method="post">
                所属分类：<select class="form-control" name="cid">
                    <?php
                    $sql3="select * from category where pid=".$_GET["cid"];
                    $result3=$db->query($sql3);
                    $result3->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row3=$result3->fetch()){
                        ?>
                        <option value="<?php echo $row3['cid']?>"><?php echo $row3["cname"]?></option>
                        <?php
                    }
                    ?>
                </select>
                博客主题：<input class="form-control" type="text" name="stitle"><br>
                博客简单描述：<input class="form-control" type="text" name="sintro"><br>
                博客主要内容：
                <script name="scon" id="editor" type="text/plain" style="width:100%;height:200px;">  </script>
                <br>
                博客封面图片：
                <div class="parent"></div>
                <input type="hidden" class="simg" name="simg"><br>
                <input type="hidden" value="<?php echo isset($_SESSION["uid"])?$_SESSION["uid"]:0?>" name="uid"><br>
                <button class="btn btn-info" type="submit">发表博客</button>
            </form>
            <ul class="blogList blogList1">
                <?php
                include "../public/db.php";
                $sql0="select * from category where pid=".$_GET["cid"];
                $result0=$db->query($sql0);
                $result0->setFetchMode(PDO::FETCH_ASSOC);
                while ($row0=$result0->fetch()){
                    $sql="select * from shows where cid=".$row0["cid"]." limit 0,6";
                    $result=$db->query($sql);
                    $result->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row=$result->fetch()){
                        if($row["uid"]==0){
                            ?>
                        <li>
                            <a class="blog-img" href="article.php?sid=<?php echo $row['sid']?>">
                                <img src="../admin/<?php echo $row['simg']?>" alt="" />
                            </a>
                            <a href="article.php?sid=<?php echo $row['sid']?>"><?php echo $row["stitle"]?></a>
                            <span>
							<?php echo $row["scon"]?>
						</span><br />
                            <p>
                                2017-9-20 admin    <span>999+人已浏览</span>
                            </p>
                        </li>
                        <?php
                    }else{      ?>
                            <li>
                                <a class="blog-img" href="article.php?sid=<?php echo $row['sid']?>">
                                    <img src="<?php echo $row['simg']?>" alt="" />
                                </a>
                                <a href="article.php?sid=<?php echo $row['sid']?>"><?php echo $row["stitle"]?></a>
                                <span>
							<?php echo $row["scon"]?>
						</span><br />
                                <p>
                                    2017-9-20 admin    <span>999+人已浏览</span>
                                </p>
                            </li>
                        <?php
                        }}}
                ?>
            </ul>
            <ul class="myBlogList blogList">
                <?php
                if(isset($_SESSION["uid"])){

                    $sql="select * from shows where uid=".$_SESSION["uid"];
                    $result=$db->query($sql);
                    $result->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row=$result->fetch()){
                            ?>
                            <li>
                                <a class="blog-img" href="article.php?sid=<?php echo $row['sid']?>">
                                    <img src="<?php echo $row['simg']?>" alt="" />
                                </a>
                                <a href="article.php?sid=<?php echo $row['sid']?>"><?php echo $row["stitle"]?></a>
                                <span>
							<?php echo $row["scon"]?>
						</span><br />
                                <p>
                                    2017-9-20 admin    <span>999+人已浏览</span>
                                </p>
                            </li>
                        <?php
                        }                }

                ?>
            </ul>
        </div>
        <div class="blogMore">
            <form action="">
                <input type="text" placeholder="" />
                <button class="blogBtn glyphicon glyphicon-search"></button>
            </form>
            <h3>为你推荐</h3>
            <ul>
                <?php
                include "../public/db.php";
                $sql0="select * from category where pid=".$_GET["cid"];
                $result0=$db->query($sql0);
                $result0->setFetchMode(PDO::FETCH_ASSOC);
                while ($row0=$result0->fetch()){
                    $sql="select * from shows where cid=".$row0["cid"]." limit 0,6";
                    $result=$db->query($sql);
                    $result->setFetchMode(PDO::FETCH_ASSOC);
                    while ($row=$result->fetch()){
                    ?>
                    <li><a href="article.php?sid=<?php echo $row['sid']?>"><?php echo $row["stitle"]?></a></li>
                    <?php
                }
                }
                ?>
            </ul>
            <hr color="#F0F2F5" width="1"/>
            <div class="a-box">
                <p cid="<?php echo $_GET['cid']?>">全部文章</p>
                <?php
                $sql1="select * from category where pid=".$_GET["cid"];
                $result1=$db->query($sql1);
                $result1->setFetchMode(PDO::FETCH_ASSOC);
                while ($row1=$result1->fetch()){
                    ?>
                    <p cid="<?php echo $row1['cid']?>"><?php echo $row1["cname"]?></p>
                    <?php
                }
                ?>
            </div>
        </div>
    </main>
</section>
<script>
    var ue = UE.getEditor('editor');
    window.onload= function () {
        var upobj=new upload();
        upobj.selectFileStyle="border-radius:5px;background:orange;cursor:pointer;width:150px;height:35px;line-height:35px";
        upobj.selectBtnStyle="width:75px;height:35px;line-height:35px;padding:4px 12px;border-radius:5px;background:#31b0d5;color:#fff";
        upobj.createView({parent:document.querySelector(".parent")});
        upobj.up("upload.php",function (e) {
            var str=e.join(";");
            $(".simg").val(str);
        })
    }
</script>
<?php
include "../public/footer.php";
?>