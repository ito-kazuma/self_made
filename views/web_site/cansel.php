<?php
$host     = 'localhost';
$username = 'root';   // MySQLのユーザ名
$password = 'KAZUMA0909';       // MySQLのパスワード
$dbname   = 'Football';   // MySQLのDB名
$charset  = 'utf8';   // データベースの文字コード
$dsn = 'mysql:dbname='.$dbname.';host='.$host.';charset='.$charset;
try {
  // データベースに接続
  $dbh = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  // SQL文を作成
  $sql = 'DELETE FROM reserve WHERE user_id =:user_id AND event_id=:event_id';
  $sth = $dbh->prepare($sql);
  $sth->bindValue(':user_id',$_GET['user_id'],PDO::PARAM_INT);
  $sth->bindValue(':event_id',$_GET['id'],PDO::PARAM_INT);
  $sth->execute();
  header('Location:top.php');
  exit();
} catch (PDOException $e) {
  echo '接続できませんでした。理由：'.$e->getMessage();
}

 ?>
