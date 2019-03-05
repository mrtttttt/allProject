<?php
session_start();
include "../public/db.php";
$code=$_POST["code"];
if($code!=$_SESSION["code"]){
    echo "<script>alert('验证码错误');location.href='login.php';</script>";
    exit;
}
$uname=$_POST["username"];
$upass=md5($_POST["password"]);

$sql="select * from user where uname='{$uname}' and upass='{$upass}'";
$result=$db->query($sql);
if($result->rowCount()){
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $row=$result->fetch();
    $_SESSION["user"]="yes";
    $_SESSION["uname"]=$uname;
    $_SESSION["uid"]=$row["uid"];
    echo "<script>alert('登陆成功');location.href='".$_SESSION['preUrl']."'</script>";
    unset($_SESSION["preUrl"]);
}else{
    echo "<script>alert('用户名或密码错误，请重新登陆');location.href='login.php'</script>";
}

