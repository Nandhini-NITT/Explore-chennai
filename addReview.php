<?php
$review=$_GET['review'];
$id=$_GET['id'];
$star=$_GET['stars'];
$visibility=$_GET['visibility'];
include "connect.php";
session_start();
$stmt=$conn->prepare("INSERT INTO user_reviews (user_id,venue_id,review,star,visibility) VALUES (?, ?, ?,?,?)");
$stmt->bind_param('sssis',$_SESSION['user'],$id,$review,$star,$visibility);
if($stmt->execute())
{
	echo "Review added successful";
}
?>
