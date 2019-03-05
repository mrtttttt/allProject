<?php
$jid=$_GET["jid"];
include "../public/db.php";
$sql="delete from job where jid=".$jid;
if($db->exec($sql)){
    echo "<script>alert('删除成功');location.href='showJob.php';</script>";
}