<?php
$sql="Insert into friendrequest_tray (sender,receiver) values (?,?)";
include "connect.php";
session_start();
$query=$conn->prepare($sql);
$query->bind_param('ss',$_SESSION['user'],$_GET['id']);
$query->execute();
echo "Friendrequest sent";
?>
		