<?php
include "connect.php";
session_start();
if(!isset($_FILES['userfile']))
		{
			echo '<p>Please select a file</p>';
		}
		else
		{
			$image = $_FILES['userfile']['tmp_name'];
			$img = file_get_contents($image);
		}
	$query = $conn->prepare("Update users set Image=? where username=?");
	$query->bind_param('ss',$img,$_SESSION['user']);
	if($query->execute())
	{
		header("Location: profile.php");
		$_SESSION['dp']=$img;
		echo $img;
	}
	else
		echo "Failed";
	
?>