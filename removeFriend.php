<?php
include "connect.php";
session_start();
$user=$_GET['id'];
$sql="Delete from friendrequest_tray where (sender='".$user."' and receiver='".$_SESSION['user']."') or (receiver='".$user."' and sender='".$_SESSION['user']."')";
$stmt1=$conn->query($sql);
if($stmt1==true)
{
	echo "You have declined the request";
}
else
{	
$sql="Delete from friendship where (user1='".$user."' and user2='".$_SESSION['user']."') or (user2='".$user."' and user1='".$_SESSION['user']."')";
$stmt=$conn->query($sql);
if($stmt==false)
	echo "There was some problem connecting to database";
else
	echo "You have removed".$user."from your friend list";
}
?>