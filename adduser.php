<html>
<head>
	<title>Signup</title>
	
	<link rel="stylesheet" type="text/css" href="register.css">
</head>
<body>
	<?php $Error=" ";?>
	<form enctype="multipart/form-data" action="registeruser.php" method="post" id="fields">
		<p><span id="errorstatus">* required field.<?php if ($Error!=" ") echo "-"+$Error;?></span></p>
		<table>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="name" required></td>
				<td><span class="error">*</span></td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="uname" required></td>
				<td><span class="error">* </span></td>
			</tr>
			<tr>
				<td>Email id:</td>
				<td><input type="email" name="email" required></td>
				<td><span class="error">* </span></td>
			</tr>
			<tr>
				<td>Phone Number:</td>
				<td><input type="number" name="phno" required></td>
				<td><span class="error">*</span></td>
			</tr>
			<tr> 
				<td>Gender:(M-Male F-Female)</td>
				<td><input type="text" name="gender" required></td>
				<td><span class="error">* </span><td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="pass" data-toggle="tooltip" data-placement="right" title="Password must contain minimum 5 characters,1 uppercase letter,1 lowercase letter and 1 number" required></td>
				<td><span class="error">*</span><td>
			</tr>
			<tr>
				<td>Profile Picture</td>
				<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
				<td><input name="userfile" type="file" id="files" required/></td>
				<td><span class="error">*</span></td>
			</tr>
				<tr><img id="imagepreview"></tr>
		</table>
		<br><br><br>
	<button type="submit" name="submit" value="Submit" onclick="return validateForm();">Submit</button>
	</form>
	<p style="position:absolute;bottom:0;left:45%">Made with <span style="font-size:150%;color:red;">&hearts;</span> by Nandhini</p>
<script  src="scripts/validation.js" type="text/javascript" >
    </script>
</body>
</html>
