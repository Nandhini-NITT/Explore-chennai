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
		if(checkaccess($row))
		echo "<li>".identifyAuthor($row)."</li><li>".$row['Review']."</li>".insertStar($row['star']);
		$control++;
	}
}
function identifyAuthor($row)
{
	$name=$row['user_id'];
	if(isset($_SESSION['user']))
	{
		if($name==$_SESSION['user'])
			echo "<a role='menuitem' tabindex='-1' href='viewprofile.php?username=".$name."'>Your review</a>";
		else if($name==$_SESSION['user'] && $row['Anonymous']==1)
			echo "<a role='menuitem' tabindex='-1' href='viewprofile.php?username=".$name."'>Your review(Posted as anonymous)</a>";
		return;
	}
	
	if($row['Anonymous']==1)
		echo "<li>Anonymous</li>";
	else if($row['Anonymous']==0)
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
function checkaccess($row)
{
	if($row['visibility']==="Public")
		return true;
	else if($row['visibility']=="Only Friends")
	{
		if($row['user_id']==$_SESSION['user'])
			return true;
		include "connect.php";
		$user=$row['user_id'];
		$sql="Select user1 from friendship where (user1='".$user."' and user2='".$_SESSION['user']."') or (user2='".$user."' and user1='".$_SESSION['user']."')";
		$stmt=$conn->query($sql);
		if($stmt->num_rows==0)
			return false;
			
	}
}
?>