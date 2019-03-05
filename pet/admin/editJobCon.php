<?php
$jname=$_POST["jname"];
$jnum=$_POST["jnum"];
$jprice=$_POST["jprice"];
$jplace=$_POST["jplace"];
$jintro=$_POST["jintro"];
$jrequired=$_POST["jrequired"];
$jid=$_POST["jid"];
include "../public/db.php";
$sql="update job set jname='{$jname}',jnum='{$jnum}',jprice='{$jprice}',jplace='{$jplace}',jintro='{$jintro}',jrequired='{$jrequired}' where jid=".$jid;
if($db->exec($sql)){
    echo "<script>alert('修改成功');location.href='showJob.php';</script>";
}