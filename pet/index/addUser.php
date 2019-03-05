<?php
session_start();
//验证码验证
$code=$_POST["code"];
$uname=$_POST["username"];
$upass=$_POST["password"];
$upass1=$_POST["password1"];
if($_SESSION["code"]!=$code){
    echo "<script>alert('验证码不正确');location.href='register.php';</script>";
    exit;
}
//2.正则验证
if(!preg_match("/^\w{2,16}/",$uname)){
    echo "<script>alert('用户名格式不正确');location.href='register.php';</script>";
    exit;
}
if(!(preg_match("/^\w{6,}/",$upass) && preg_match("/^\w{6,}/",$upass1) && $upass==$upass1)){
    echo "<script>alert('密码格式不正确');location.href='register.php';</script>";
    exit;
}
//3.用户名验证
include "../public/db.php";
$sql0="select * from user where uname='{$uname}'";
$result=$db->query($sql0);
if($result->rowCount()!=0){
    echo "<script>alert('用户名已存在');location.href='register.php';</script>";
    exit;
}
$upass=md5($upass);
$sql="insert into user(uname,upass,uimg) values('{$uname}','{$upass}','')";
if($db->exec($sql)){
    echo "<script>alert('注册成功');location.href='login.php';</script>";
}