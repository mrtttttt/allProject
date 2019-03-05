<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["uname"]);
unset($_SESSION["uid"]);
echo "<script>alert('已退出登陆');location.href='index.php'</script>";