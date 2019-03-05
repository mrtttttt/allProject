<?php
session_start();
include "../public/db.php";
if(!isset($_SESSION["user"])){
    echo <<<ETO
<script>
if(confirm("你处于未登陆状态，是否现在去登陆？")){
    location.href="login.php";
}else{
    location.href='{$_SESSION["preUrl"]}';
}
</script>
ETO;
    exit;
}
$mtitle=$_POST["mtitle"];
$mcon=$_POST["mcon"];
$uid1=$_POST["uid1"];
$uid2=$_POST["uid2"];
$sid=$_POST["sid"];
date_default_timezone_set("PRC");
$mtime=date("Y-m-d H:i:s",time());
$sql="insert into message(uid1,uid2,mtitle,mcon,mtime,sid) values('{$uid1}','{$uid2}','{$mtitle}','{$mcon}','{$mtime}','{$sid}')";
if($db->exec($sql)){
    echo "<script>alert('留言成功');location.href='".$_SESSION['preUrl']."'</script>";
    unset($_SESSION["preUrl"]);
}
?>