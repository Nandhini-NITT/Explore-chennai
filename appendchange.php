<?php
	$_SESSION['Error']="";
	if($_SERVER["REQUEST_METHOD"]=="POST")
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
			$_SESSION['Error']="Name is Required!";
		else if(!preg_match("/^[a-zA-Z ]*$/",$name)) 
			$_SESSION['Error'] = "Only letters and white space allowed"; 
		else if(empty($_POST["uname"]))
			$_SESSION['Error']="Username is required";
		else if(empty($_POST["email"]))
			$_SESSION['Error']="Email id is required";
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
			$_SESSION['Error'] = "Invalid email format";
		else if(empty($_POST["phno"]))
			$_SESSION['Error']="Phone Number is required";
		else if(preg_match("/^[1-9][0-9]{5,10}$/",$phno))
			$_SESSION['Error']="Invalid Phone number";
		if(!isset($_FILES['userfile']))
		{
			echo '<p>Please select a file</p>';
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
				header("Location: profile.php");
			}
		}
		else
			$_SESSION['Error']="The emailid/password/Username is already registered";
			
	}
?>