<?php
$name=$_GET['name'];
include("connect.php");
$query = $conn->prepare("SELECT Username FROM users WHERE username=?");
$query->bind_param('s',$name);
$query->execute();
$query->bind_result($name);
$query->store_result();
if($query->num_rows==0)
	echo 1;
else
	echo 0;
?>