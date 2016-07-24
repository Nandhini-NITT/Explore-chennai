<?php
include "connect.php";
session_start();
if(isset($_SESSION['user'])==1)
{
	
	if(!isset($_GET['name']))
	{
		$name=$_SESSION['user'];
		viewCheckin($name);
	}
	else
	{
		$name=$_GET['name'];
		if(checkFriendship())
		{
			viewCheckin($name);
		}
	}
}
function viewCheckin($name)
{		
	$sql="Select * from checkins where user_id='".$name."'";
	include "connect.php";
	$query=$conn->query($sql);
	if($query->num_rows==0)
		echo "No checkins added";
	else
	{
		$control=0;
		while($control<$query->num_rows)
		{
			$row=$query->fetch_assoc();
			echo "<div id='checkin".$control."'><li><a href='viewVenue.php?id=".$row['venue_id']."'>".$row['venue_name']."</a>&nbsp&nbsp".$row['Date']."</li></div>";
			$control++;
		}
	}
}
function checkFriendship()
{
	include "connect.php";
	$user=$_GET['name'];
	$sql="Select user1 from friendship where (user1='".$user."' and user2='".$_SESSION['user']."') or (user2='".$user."' and user1='".$_SESSION['user']."')";
	$stmt=$conn->query($sql);
	if($stmt->num_rows==0)
		return false;
	else
		return true;
}
?>