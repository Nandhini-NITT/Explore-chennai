<?php
include "connect.php";
session_start();
if(!isset($_SESSION['user']))
	header("Location:chennai.php");
else
{
	$sql="Delete from user_reviews where user_id='".$_SESSION['user']."'";
	$stmt=$conn->query($sql);
	if($stmt==true)
		echo "Existing review deleted.Write a new one";
	else
		echo "There was some problem";
}
?>