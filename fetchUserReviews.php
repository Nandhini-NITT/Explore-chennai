<?php
include "connect.php";
session_start();
if(!isset($_SESSION['user']))
	header("Location:chennai.php");
else
{
	$sql="Select * from user_reviews where user_id='".$_SESSION['user']."'";
	$query=$conn->query($sql);
	$control=0;
	while($control<$query->num_rows)
	{
		$row=$query->fetch_assoc();
		echo "<div id='venue".$control."'>".$row['venue_id']."</div><li>".$row['Review']."</li>".insertStar($row['star']).checkAnonymous($row)."<li style='float:right'>Audience: ".$row['visibility']."</li>";
		$control++;
	}
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
function checkAnonymous($row)
{
	if($row['Anonymous']==1)
		echo "<li style='float:right'>Posted as Anonymous</li>";
}

?>