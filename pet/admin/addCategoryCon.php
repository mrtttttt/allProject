<?php
$pid = $_POST["pid"];
$cname=$_POST["cname"];
$cenglish=$_POST["cenglish"];
$cintro=$_POST["cintro"];
$cimg=$_POST["cimg"];
$isshow=isset($_POST["isshow"])?$_POST["isshow"]:-1;
include "../public/db.php";
$sql = "insert into category(cname,cenglish,cintro,pid,state,cimg,isshow) VALUES ('{$cname}','{$cenglish}','{$cintro}','{$pid}',0,'{$cimg}','{$isshow}')";
if($db->exec($sql)){
    if($pid!=0){
        $sql1="update category set state=1 where cid=".$pid;
        $db->exec($sql1);
        echo "<script>alert('添加成功');location.href='addCategory.php'</script>";
    }else{
        echo "<script>alert('添加成功');location.href='addCategory.php'</script>";
    }
}