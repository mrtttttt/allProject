<?php
$sid =$_POST["sid"];
$cid =$_POST["cid"];
$stitle=$_POST["stitle"];
$sintro=$_POST["sintro"];
$scon=$_POST["scon"];
$simg=$_POST["simg"];
$sprice=$_POST["sprice"];
$snum=$_POST["snum"];
$posid=isset($_POST["posid"])?$_POST["posid"]:0;
include "../public/db.php";
$sql="update shows set stitle='{$stitle}',sintro='{$sintro}',scon='{$scon}',simg='{$simg}',sprice='{$sprice}',snum='{$snum}',cid='{$cid}',posid='{$posid}' where sid=".$sid;
if($db->exec($sql)){
        echo "<script>alert('修改成功');location.href='showCon.php'</script>";
}