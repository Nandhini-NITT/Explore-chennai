<?php
include "connect.php";
session_start();
$sql="Select * from checkins where user_id='".$_SESSION['user']."'";
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
?>