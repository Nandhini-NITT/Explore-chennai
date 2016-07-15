<?php
include "connect.php";
$field="";
$changedvalue="";
foreach($_GET as $param => $value){
$field=$param;
$changedvalue=$value;
}
session_start();
	
	$query = $conn->prepare("SELECT Username FROM users WHERE {$field}=?");
	$query->bind_param('s',$changedvalue);
	$query->execute();
	$query->bind_result($name);
	$query->store_result();
		if($query->num_rows!=0 && ($field=="Email" || $field=="Phno"))
		{
			echo 'Given Email/Phone number is already taken';
		}
		else
		{
			$query=$conn->prepare("Update users set {$field}=? where username=?");
			$query->bind_param('ss',$changedvalue,$_SESSION['user']);
			$query->execute();
			echo $changedvalue;
		}
?>