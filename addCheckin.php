<?php
$venue_id= $_GET['id'];
$venue_name=$_GET['name'];
$current_date = date("d-m-y");
include "connect.php";
session_start();
if(!isset($_SESSION['user'])
{
	?><script>alert("Please Log in to continue");</script><?php
}
else
{
	$query=$conn->prepare("Insert into checkins (user_id,venue_id,venue_name,Date) values (?,?,?,?)");
	$query->bind_param('ssss',$_SESSION['user'],$venue_id,$venue_name,$current_date);
	$query->execute();
	if($query->affected_rows==1)
		echo "Checkin added";
	else
		echo "Something went wrong try again later";
}
?>