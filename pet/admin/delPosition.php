<?php
$posid=$_GET["posid"];
include "../public/db.php";
$sql="delete from position where posid=".$posid;
if($db->exec($sql)){
    echo "<script>alert('删除成功');location.href='showPosition.php'</script>";
}