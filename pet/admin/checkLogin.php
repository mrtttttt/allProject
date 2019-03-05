<?php
session_start();
$aname=addslashes(htmlspecialchars($_POST["username"]));
$apass = md5($_POST["password"]);
include "../public/db.php";
$sql = "select * from admin where aname='$aname' and apass = '$apass'";
$result=$db->query($sql);
if($result->rowCount()){
    $_SESSION["login"]="ok";
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $row = $result->fetch();
    $_SESSION["aid"]=$row["aid"];
    echo "<script>alert('登陆成功');location.href='index.php'</script>";
}else{
    $tip="登陆失败";
    $url="login.php";
    include "../public/message.php";
}