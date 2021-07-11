<?php
session_start();
if(!$_SESSION['login']){
    header('Location: login.html');
}
?>
<!DOCTYPE html>
<html>
<body>
    ログイン成功！
</body>
</html>
