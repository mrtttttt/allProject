<?php
$cid = $_POST["cid"];
$stitle=$_POST["stitle"];
$sintro=$_POST["sintro"];
$scon=isset($_POST["scon"])?$_POST["scon"]:"暂无更多描述";
$simg=$_POST["simg"];
$sprice=isset($_POST["sprice"])?$_POST["sprice"]:"0.00";
$snum=isset($_POST["snum"])?$_POST["snum"]:"99";
$posid=isset($_POST["posid"])?$_POST["posid"]:0;
$uid=isset($_POST["uid"])?$_POST["uid"]:0;
include "../public/db.php";
$sql = "insert into shows(stitle,sintro,scon,simg,sprice,snum,cid,posid,uid) VALUES ('{$stitle}','{$sintro}','{$scon}','{$simg}','{$sprice}','{$snum}','{$cid}','{$posid}','{$uid}')";
if($db->exec($sql)){
    echo "<script>alert('发表博客成功');location.href='blog.php?cid=4'</script>";
}