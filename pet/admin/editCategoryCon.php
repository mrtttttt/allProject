<?php
$cid =$_POST["cid"];
$cname=$_POST["cname"];
$cenglish=$_POST["cenglish"];
$cintro=$_POST["cintro"];
$pid=$_POST["pid"];
$cimg=$_POST["cimg"];
include "../public/db.php";
$sql1="select * from category where cid=".$cid;
$result=$db->query($sql1);
$result->setFetchMode(PDO::FETCH_ASSOC);
$row=$result->fetch();
$oldPid=$row["pid"];
$sql="update category set cname='{$cname}',cenglish='{$cenglish}',cintro='{$cintro}',pid='{$pid}',cimg='{$cimg}' where cid=".$cid;
if($db->exec($sql)){
    //将修改后的父元素state变为1
    $sql4="update category set state=1 where cid=".$pid;
    $db->exec($sql4);
    //判断修改前的父元素是否还有子分类，若没有，将state变为0
    $sql2="select count(cid) as num from category where pid=".$oldPid;
    $result2=$db->query($sql2);
    $result2->setFetchMode(PDO::FETCH_ASSOC);
    $row2=$result2->fetch();
    $num=$row2["num"];
    if($num>0){
        echo "<script>alert('修改成功');location.href='showCategory.php'</script>";
    }else{
        $sql3="update category set state=0 where cid=".$oldPid;
        $db->exec($sql3);
        echo "<script>alert('修改成功');location.href='showCategory.php'</script>";
    }
}