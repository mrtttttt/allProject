<?php
$aname=$_GET["aname"];

include "../public/db.php";

$sql = "select * from admin where aname='{$aname}'";
$result = $db->query($sql);
if($result->rowCount()){        //受上一句操作所影响的行数
    echo "false";
}else{
    echo "true";
}