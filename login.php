<html>
<head>
	<title>Login</title>
	<!--<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->
</head>
<body>
<?php
if(isset($_SESSION['user'])==1)
	{
		header("Location:profile.php");
	}
	else
	{	
		$flag=0;
		if($_SERVER['REQUEST_METHOD']=="POST" )
		{
			include "connect.php";
			session_start();
			$user=$_POST["uname"];
			echo $user;
			$inputpass=SHA1($_POST["password"]);
			$sql=$conn->prepare("SELECT username,passcode from users where username=? or Phno=?");
			$sql->bind_param('ss',$user,$user);
			$sql->execute();
			$sql->bind_result($name,$pass1);
			while (($status = $sql->fetch()) === true) 
			{ 
				if($pass1===$inputpass)
				{
					$flag=1;
					$_SESSION["user"]=$name;
					echo $_SESSION['user'];
					header('Location:profile.php');
				}
			}
		if($flag==0){
		echo "Invalid login credentials";
		}
		}	
	}
?>
<div id='signin' style='display:table;margin:0 auto'>
<form action="" method="post" style="float:right;top:20%;position:relative" id="signin">
		<h1 align="center">SIGNIN</h1>
		Username or Phone number:
		<input type="text" name="uname">
		Password:
		<input type="password" name="password">
		<br>
		<button type="submit" name="submit" value="Submit">Submit</button>
		<br>
		Not registered yet?? <a href='adduser.php'>Signup</a>
</form>
</div>
</body>
</html>