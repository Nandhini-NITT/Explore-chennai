<?php
include "connect.php";
$review=$_GET['review'];
$id=$_GET['id'];
$star=$_GET['stars'];
$stmt=$conn->prepare("INSERT INTO anonymoususer (venue_id,review,star) VALUES (?,?,?)");
$stmt->bind_param('ssi',$id,$review,$star);
$stmt->execute();

if($conn->affected_rows==1)
{
	echo "Review added successful";
}
?>