<?php
$posid=$_POST["posid"];
$posname=$_POST["posname"];
include "../public/db.php";
$sql="update position set posname='{$posname}' where posid=".$posid;
if($db->exec($sql)){
    echo "<script>alert('修改成功');location.href='showPosition.php'</script>";
}