<?php
include "connect.php";
$row="";
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
		echo "<li>".identifyAuthor($row['user_id'])."</li><li>".$row['Review']."</li>".insertStar($row['star']);
		$control++;
	}
}
function identifyAuthor($name)
{
	if($name==$_SESSION['user'])
	echo "<a role='menuitem' tabindex='-1' href='viewprofile.php?username=".$name."'>Your review</a>";
	else
	echo "<a role='menuitem' tabindex='-1' href='viewprofile.php?username=".$name."'>".$name."</a>";
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