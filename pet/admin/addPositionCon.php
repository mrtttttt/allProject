<?php
include "../public/db.php";
$posname=$_POST["posname"];
$sql="insert into position (posname) values ('{$posname}')";
if($db->exec($sql)){
    echo "<script>alert('添加成功');location.href='addPosition.php'</script>";
}