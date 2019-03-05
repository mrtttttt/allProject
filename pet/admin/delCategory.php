<?php
$cid=$_GET["cid"];
include "../public/db.php";
$sql = "select * from category where pid=".$cid;
$result=$db->query($sql);
if($result->rowCount()==0){
    $sql1="select pid from category where cid=".$cid;
    $result1=$db->query($sql1);
    $result1->setFetchMode(PDO::FETCH_ASSOC);
    $row1=$result1->fetch();
    $pid=$row1["pid"];
    $sql = "delete from category where cid=".$cid;
    if($db->exec($sql)){
        $sql2="select count(cname) as num from category where pid=".$pid;
        $result2=$db->query($sql2);
        $result2->setFetchMode(PDO::FETCH_ASSOC);
        $row2=$result2->fetch();
        if($row2["num"]==0){
            $sql3="update category set state=0 where cid=".$pid;
            if($db->exec($sql3)){
                echo "<script>alert('删除成功');location.href='showCategory.php'</script>";
            }
        }else{
            echo "<script>alert('删除成功');location.href='showCategory.php'</script>";
        }
    }
}else{
    echo "<script>alert('有子分类，不能删除');location.href='showCategory.php'</script>";
}