<?php
$review=$_GET['review'];
$id=$_GET['id'];
include "connect.php";
session_start();
$stmt=$conn->prepare("INSERT INTO user_reviews (user_id,venue_id,review) VALUES (?, ?, ?)");
$stmt->bind_param('sss',$_SESSION['user'],$id,$review);
if($stmt->execute())
{
	echo "Review added successful";
}
?>
