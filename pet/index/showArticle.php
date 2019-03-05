<?php
$cid=$_GET["cid"];
include "../public/db.php";
$arr=array();
if($cid==4){
    $sql="select * from category where pid=".$cid;
    $result=$db->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    while ($row=$result->fetch()){
        $sql1="select * from shows where cid=".$row["cid"];
        $result1=$db->query($sql1);
        $result1->setFetchMode(PDO::FETCH_ASSOC);
        while($row1=$result1->fetch()){
            $arr[]=$row1;
        }
    }
    echo json_encode($arr);
}else{
    $sql="select * from shows where cid=".$cid;
    $result=$db->query($sql);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    while($row=$result->fetch()){
            $arr[]=$row;
    }
    echo json_encode($arr);
}
?>