<?php

	if($_SERVER['REQUEST_METHOD']=="POST")
	{
		session_start();
		$fullname=$_POST["name"];
		$name=$_POST["uname"];
		$email=$_POST["email"];
		$phno=(string) $_POST["phno"];
		$gender=$_POST["gender"];
		$pass=SHA1($_POST["pass"]);
		//Backend form validation
		if(empty($_POST["name"]))
			echo "Name is Required!";
		else if(!preg_match("/^[a-zA-Z ]*$/",$name)) 
			echo "Only letters and white space allowed"; 
		else if(empty($_POST["uname"]))
			echo "Username is required";
		else if(empty($_POST["email"]))
			echo "Email id is required";
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			echo  "Invalid email format";
		else if(empty($_POST["phno"]))
			echo "Phone Number is required";
		else if(preg_match("/^[1-9][0-9]{5,10}$/",$phno))
			echo "Invalid Phone number";
		if(!isset($_FILES['userfile']))
		{
			echo 'Please select a file';
		}
		else
		{
			$image = $_FILES['userfile']['tmp_name'];
			$img = file_get_contents($image);
		}
		include("connect.php");
		$query = $conn->prepare("SELECT Username FROM users WHERE Phno= ? or email=? or username=?");
		$query->bind_param('sss',$phno, $email, $name);
		$query->execute();
		$query->bind_result($name);
		$query->store_result();
		if($query->num_rows==0)
		{
			$stmt=$conn->prepare("INSERT INTO users (Username,Name,email,Phno,Gender,Passcode,Image) VALUES (?, ?, ?, ?, ?, ? ,?)");
			$stmt->bind_param('sssssss', $name,$fullname, $email, $phno, $gender, $pass,$img);
			if($stmt->execute())
			{
				echo "Update successful";
				$_SESSION["user"]=$name;
				header("Location: chennai.php");
			}
		}
		else
			$Error="The emailid/password/Username is already registered";
			
	
	}
?>