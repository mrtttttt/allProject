<?php
session_start();
unset($_SESSION["login"]);
unset($_SESSION["aid"]);
echo "<script>alert('已退出');location.href='login.php'</script>";