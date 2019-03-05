<?php
session_start();
if(!isset($_SESSION["login"])){
    $tip="未登录，将转到登陆页面";
    $url="login.php";
    include "../public/message.php";
    exit;
}
?>