<?php
/*$arr=array(
  "name"=>$user,"pass"=>$pass,"age"=>$age,"sex"=>$sex,"phone"=>$phone
);
$data=json_decode(file_get_contents("user.txt"),true);
$data[]=$arr;
file_put_contents("user.txt",json_encode($data));
echo "<script>alert('插入成功'); location.href='addUser.php'</script>";*/

include "../public/db.php";
$aname=$_POST["aname"];
$apass=md5($_POST["apass"]);
$anicheng = $_POST["anicheng"];
$aphoto = $_POST["aphoto"];

$sql=("insert into admin(aname,apass,anicheng,aphoto) VALUES ('{$aname}','{$apass}','{$anicheng}','{$aphoto}')");
if($db->exec($sql)){
    echo "<script>alert('插入成功'); location.href='addUser.php'</script>";
}