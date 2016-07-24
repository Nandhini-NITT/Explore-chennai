<?php
session_start();
$review=$_GET['review'];
$id=$_GET['id'];
$star=$_GET['stars'];
$visibility=$_GET['visibility'];
$name=$_SESSION['user'];
include "connect.php";
$stmt=$conn->prepare("INSERT INTO user_reviews (user_id,venue_id,review,star,visibility) VALUES (?, ?, ?,?,?)");
$stmt->bind_param('sssis',$name,$id,$review,$star,$visibility);
$stmt->execute();
if($stmt->affected_rows==1)
{
	echo "Review added successful";
}

?>
