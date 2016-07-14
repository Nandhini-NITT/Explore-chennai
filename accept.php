<?php
include "connect.php";
session_start();
$sql="Insert into friendship (user1,user2) values ('".$_SESSION['user']."','".$_GET['id']."')";
$stmt=$conn->query($sql);
$sql="Delete from friendrequest_tray where sender='".$_GET['id']."' and receiver='".$_SESSION['user']."'";
$stmt=$conn->query($sql);
echo "Friendrequest accepted";
?>