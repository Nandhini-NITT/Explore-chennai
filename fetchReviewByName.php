<?php
include "connect.php";
session_start();
$sql="Select * from user_reviews where user_id='".$_GET['id']."'";
$query=$conn->query($sql);
$control=0;
while($control<$query->num_rows)
{
	$row=$query->fetch_assoc();
	if($row['visibility']=="Public" && $row['Anonymous']==0)
		echo "<div id='venue".$control."'>".$row['venue_id']."</div><li>".$row['user_id']."</li><li>".$row['Review']."</li>".insertStar($row['star']);
	else if($row['visibility']=="Only Friends" && $row['Anonymous']==0)
	{
		if(checkFriendship())
		{
			echo "<div id='venue".$control."'>".$row['venue_id']."</div><li>".$row['user_id']."</li><li>".$row['Review']."</li>".insertStar($row['star']);
		}
	}
	$control++;
}
function checkFriendship()
{
	include "connect.php";
	$user=$_GET['id'];
	$sql="Select user1 from friendship where (user1='".$user."' and user2='".$_SESSION['user']."') or (user2='".$user."' and user1='".$_SESSION['user']."')";
	$stmt=$conn->query($sql);
	if($stmt->num_rows==0)
		return false;
	else
		return true;
}
function insertStar($star)
{
	$control=0;
	while($control<$star)
	{
		echo "<span style='color:gold;size:40%;display:inline-block;font-size:30px'>&#9733;</span>";	
		$control++;
	}
}
?>