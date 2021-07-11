<?php
session_start();
if(!isset($_POST['delete'])){
  header("Location:login.php");
  exit();
}
require_once(ROOT_PATH .'controller/user_controller.php');
$event = new user_controller();
$delete = $event->Event_del();
 ?>
