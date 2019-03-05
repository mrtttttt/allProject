<?php
$uname=$_GET["username"];
include "../public/db.php";
$sql="select * from user where uname='{$uname}'";
$result=$db->query($sql);
if($result->rowCount()){
    echo "false";
}else{
    echo "true";
}