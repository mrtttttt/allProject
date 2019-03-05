<?php
include "../public/db.php";
$aname=$_POST["aname"];
$aid=$_GET["aid"];
$apass=$_POST["apass"];
$anicheng = $_POST["anicheng"];
$aphoto = $_POST["aphoto"];
if($apass){
    $apass=md5($apass);
    $sql="update admin set aname='{$aname}',apass='{$apass}',anicheng='{$anicheng}',aphoto='{$aphoto}' where aid='{$aid}'";

}else{
    $sql="update admin set aname='{$aname}',anicheng='{$anicheng}',aphoto='{$aphoto}' where aid='{$aid}'";
}
if($db->exec($sql)){
    echo "<script>alert('修改成功'); location.href='showUser.php'</script>";
}