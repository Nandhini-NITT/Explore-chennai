<?php
$user=$_GET['id'];
include "connect.php";
session_start();
$sql="Select user1 from friendship where (user1='".$user."' and user2='".$_SESSION['user']."') or (user2='".$user."' and user1='".$_SESSION['user']."')";
$stmt=$conn->query($sql);
if($stmt->num_rows==0)
{
	$sql="Select * from friendrequest_tray where receiver='".$_SESSION['user']."' and sender='".$user."'";
	$stmt1=$conn->query($sql);
	if($stmt1->num_rows==0)
	{
		$sql="Select * from friendrequest_tray where sender='".$_SESSION['user']."' and receiver='".$user."'";
		$stmt=$conn->query($sql);
	
	if($stmt->num_rows==0)
	{
		echo "<button class='btn btn-primary' onClick='sendRequest();' ><span class='glyphicon glyphicon-plus'></span> &nbspAdd Friend</button>";
		
	}
	else
		echo "<button class='btn btn-success'><span class='glyphicon glyphicon-ok'></span> &nbspFriend Request sent</button>";
	}
	else 
		echo "<button class='btn btn-success' onClick='acceptRequest();'><span class='glyphicon glyphicon-ok'></span>&nbsp Accept</button>&nbsp<button class='btn btn-danger' onClick='deleteRequest();'><span class='glyphicon glyphicon-remove'></span>&nbspCancel</button>";
}
else
echo "<button class='btn btn-success'><span class='glyphicon glyphicon-user'></span>&nbsp Friends</button>";
?>