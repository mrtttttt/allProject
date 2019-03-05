<?php
session_start();
$mid=$_GET["mid"];
include "../public/db.php";
$sql="delete from message where mid=".$mid;
if($db->exec($sql)){
    echo "<script>alert('删除成功');location.href='".$_SESSION['preUrl']."';</script>";
    unset($_SESSION["preUrl"]);
}