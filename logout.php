<?php
include('inc/config.php');
unset($_COOKIE['id']);
# reset last_seen unixtimestamp
$key = $_SESSION['id'];
session_destroy();
setcookie("PHPSESSID","",time()-3600,"/");
#################################################################
$last_query = $con->query("SELECT * FROM cuentas WHERE ID='$key'");
$update_last = $last_query->fetch_row();
$last_time = $update_last[176];
#################################################################
//$con->query("UPDATE usuarios SET logout='$last_time' WHERE userid='$key'");
//$con->query("UPDATE usuarios SET last_seen='' WHERE userid='$key'");
unset($_SESSION['id']);
header('Location: login.php'); 
exit();
?>