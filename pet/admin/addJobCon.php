<?php
$jname=$_POST["jname"];
$jnum=$_POST["jnum"];
$jprice=$_POST["jprice"];
$jplace=$_POST["jplace"];
$jintro=$_POST["jintro"];
$jrequired=$_POST["jrequired"];
include "../public/db.php";
$sql="insert into job(jname,jnum,jprice,jplace,jintro,jrequired) values('{$jname}','{$jnum}','{$jprice}','{$jplace}','{$jintro}','{$jrequired}')";
if($db->exec($sql)){
    echo "<script>alert('添加成功');location.href='showJob.php';</script>";
}