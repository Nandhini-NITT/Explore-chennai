<?php
include "connect.php";
session_start();
$venue=$_GET['id'];
$sql="Select * from user_reviews where venue_id='".$venue."'";
$query=$conn->query($sql);
if($query==true)
{
	$control=0;
	while($control<$conn->affected_rows)
	{
		$row=$query->fetch_assoc();
		echo "<li><a role='menuitem' tabindex='-1' href='viewprofile.php?username=".$row['user_id']."'>".$row['user_id']."</a></li><li>".$row['Review']."</li>".insertStar($row['star']);
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
?>