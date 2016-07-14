<?php
$review=$_GET['review'];
$id=$_GET['id'];
$star=$_GET['stars'];
include "connect.php";
session_start();
$stmt=$conn->prepare("INSERT INTO user_reviews (user_id,venue_id,review,star) VALUES (?, ?, ?,?)");
$stmt->bind_param('sssi',$_SESSION['user'],$id,$review,$star);
if($stmt->execute())
{
	echo "Review added successful";
}
?>
