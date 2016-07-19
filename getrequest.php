<?php
include "connect.php";
session_start();
if(!isset($_SESSION['user']))
	header("Location:chennai.php");
else
{
	$sql="Select sender from friendrequest_tray where receiver='".$_SESSION['user']."'";
	$stmt=$conn->query($sql);
	$control=0;
	while($control<$stmt->num_rows)
	{
		$row=$stmt->fetch_assoc();
		$user = $row['sender'];
		$sql = "SELECT username,name,email,phno,gender,Image from users where username like'".$user."%'";
		$result = $conn->query($sql);
		if ($result->num_rows == 1) {
			$row1= $result->fetch_assoc();
		}
		else
			echo "Not found";
		echo "<li> <img id='dp' src='data:image/jpeg;base64,".base64_encode( $row1['Image'] )."'/><a role='menuitem' tabindex='0' href='viewprofile.php?username=".$row['sender']."'>".$row['sender']."</a></li>";
		$control++;
	}
	if($control==0)
		echo "No new requests";
}
?>