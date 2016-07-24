
	<?php
	include "connect.php";
	session_start();
	if(!isset($_SESSION['user']))
	{
	?><script>alert("Kindly login");</script><?php
	}
	else
	{
		$row;
		$control=0;
		$sql="Select * from friendship where user1='".$_SESSION['user']."' or user2='".$_SESSION['user']."'";
		$stmt=$conn->query($sql);
		if($stmt==true)
		{
			while($control<$stmt->num_rows)
			{
				$row[$control]=$stmt->fetch_assoc();
				$name=$row[$control]["user1"];
				if($name==$_SESSION['user'])
					$name=$row[$control]['user2'];
				$sql2="Select * from users where username='".$name."'";
				$stmt2=$conn->query($sql2);
				$row1=$stmt2->fetch_assoc();
				echo "<li> <img id='dp' src='data:image/jpeg;base64,".base64_encode( $row1['Image'] )."'/><a role='menuitem' tabindex='0' href='viewprofile.php?username=".$row1['username']."'>".$row1['Name']."</a></li>";
				$control++;
			}
		}
	}
	?>
