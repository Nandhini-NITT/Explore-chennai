<?php
session_start();
if(!isset($_SESSION['user']))
{
	header("Location:chennai.php");
}
else
{
	$review=$_GET['review'];
	$id=$_GET['id'];
	$star=$_GET['stars'];
	$visibility=$_GET['visibility'];
	$anonymous=$_GET['anonymous'];
	echo $anonymous;
	include "connect.php";
	$stmt=$conn->prepare("INSERT INTO user_reviews (user_id,venue_id,review,star,visibility,Anonymous) VALUES (?, ?, ?,?,?,?)");
	$stmt->bind_param('sssisi',$_SESSION['user'],$id,$review,$star,$visibility,$anonymous);
	if($stmt->execute())
	{
		echo "Review added successful";
	}
}
?>
