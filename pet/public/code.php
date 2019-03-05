<?php
session_start();
$str="3456789qwertyuopasdfghjklmnbvcxz";
$code="";
for($i=0;$i<4;$i++){
    $code.=$str[mt_rand(0,strlen($str)-1)];
}
$url="../public/code.php";
$_SESSION["code"]=$code;
echo <<<ETO
<span onclick="location.href='{$url}'">$code</span>
ETO;
