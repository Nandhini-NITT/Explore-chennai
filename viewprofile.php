<html>
	<head>
	<title><?php echo $_GET['username']; ?></title>
	<script src="jquery-1.12.2.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="profile.css">
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700italic' rel='stylesheet' type='text/css'>
	</head>
	<body><?php
	session_start();
	
	if(!isset($_SESSION['user'])){
		header('Location:chennai.php');
	}
	if(empty($_GET['username'])||$_GET['username']==$_SESSION['user']){
		header('Location:profile.php');
	}
	$user = $_GET['username'];
	include('connect.php');
	$sql = "SELECT username,name,email,phno,gender,Image from users where username like'".$user."%'";
		$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		$row1= $result->fetch_assoc();
	}
	else{
		header('Location:profile.php');
	}
	
?>
<a href="profile.php" style="position:absolute;left:5%;top:10%;font-size:20px"><=Back to your profile</a>
<div style="position:relative;left:40%">
<span class='glyphicon glyphicon-search'></span>
  <input onkeyup="findmatch();" type="text" data-toggle="tooltip" data-placement="right" title="Enter username" id="search" placeholder="Find What's up with your friends" style="width:280px;"></p>
</div>	
  <div id="img-holder">
<?php
include "connect.php";
echo '<img id="dp" src="data:image/jpeg;base64,'.base64_encode( $row1['Image'] ).'"/>';
?>
</div>
<div  id="output">
</div>
<div id="contents">
	<h1 style="position:relative;left:25px;top:30%">Contact Information</h1>
	<hr color="black">
	<table>
		<tr>
			<td width="30%">Name</td>
			<td width="40%" id="valueName"><?php echo $row1['name'];?></td>
		</tr>
		<tr>
			<td>Gender</td>
			<td id="valueGender"><?php echo $row1['gender'];?></td>
			</tr>
		<tr>
			<td>Email</td>
			<td id="valueEmail"><?php echo $row1['email'];?></td>
			
		</tr>

		
		<tr>
			<td>Phone number</td>
			<td id="valuePhno"><?php echo $row1['phno']; ?></td>
		</tr>
	
	</table>
	<br>
	<input type="button" onclick="document.location.href='logout.php'" value="Logout" style="position:relative;left:30%">
	<br><br><br><br>
	<p style="position:absolute;bottom:0;left:25%;font-size:15px">Made with <span style="font-size:150%;color:red;">&hearts;</span> by Nandhini</p>
</div>

	<script>
		function findmatch(){
		var search_text = document.getElementById('search').value;
		document.getElementById("output").style.display="block";
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				document.getElementById("output").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET','getuser.php?search_text='+search_text,true);
		xmlhttp.send();
	}
	</script>
	</body>
</html>