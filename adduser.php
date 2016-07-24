<html>
<head>x
	<title>Signup</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="scripts/parsely.min.js"></script>
	<script src='scripts/parsleyValidator.js'></script>
	<script>
	var checkUserName=function()
{
	if(document.getElementById('uname').value.length>=5)
	{
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				if(xmlhttp.responseText==1)
					document.getElementById('validity').innerHTML="<span class='glyphicon glyphicon-ok'></span>";
				else
					document.getElementById('validity').innerHTML="<span class='glyphicon glyphicon-remove'></span>";
			}
			}
		xmlhttp.open('GET','checkUserName.php?name='+document.getElementById('uname').value,true);
		xmlhttp.send();
	}
	else
		document.getElementById('validity').innerHTML="<span class='glyphicon glyphicon-remove'></span>"

};
	</script>
</head>
<body>

<div class="header">
	<h1 style="position:absolute;top:0;left:45%">Registration</h1>
</div>
	<!--<img src="signinbg.jpg" width="400" height="400" style="position:absolute;top:20%;left:10%">-->
	
	<form enctype="multipart/form-data" action="registeruser.php" method="post" id="fields" class="parsley-validate">
		<p><span id="errorstatus">* required field.</span></p>
		<table>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="name" data-parsley-trigger="keyup" data-parsley-minlength='4' data-parsley-namecheck required=""></td>
				<td><span class="error">*</span></td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><input type="text" id='uname' name="uname" onkeyup='checkUserName();' data-parsley-trigger="keyup" data-parsley-type='alphanum' data-parsley-length="[5, 15]" data-parsley-validation-threshold="5" required></td>
				<td id='validity'> <span class='glyphicon glyphicon-remove'></span></td>
				<td><span class="error">* </span></td>
			</tr>
			<tr>
				<td>Email id:</td>
				<td><input type="email" name="email" required=""></td>
				<td><span class="error">* </span></td>
			</tr>
			<tr>
				<td>Phone Number:</td>
				<td><input type="number" name="phno" data-parsley-trigger="keyup" data-parsley-length="[5, 10]" required=""></td>
				<td><span class="error">*</span></td>
			</tr>
			<tr> 
				<td>Gender:(M-Male F-Female)</td>
				<td><input type="text" name="gender" required="" data-parsley-gendercheck></td>
				<td><span class="error">* </span><td>
			</tr>
			<script>
				window.Parsley.addValidator('gendercheck', {
  validateString: function(value) {
    return value=="M" || value=="F";
  },
  messages: {
    en: 'Gender can only be M or F',
	}
	});
	window.Parsley.addValidator('namecheck', {
  validateString: function(value) {
  var iChars = "!@#$%^&*()+=-[]\';,./{}|\":<>?~_";
   for (var i = 0; i < value.length; i++) 
			{
				if (iChars.indexOf(value.charAt(i)) != -1) {
				return false;
				}
			}

  },
  messages: {
    en: 'Name can contain only letters and whitespaces',
	}
	});
	</script>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="pass" required="" data-toggle="tooltip" data-placement="right" title="Password must contain minimum 5 characters,1 uppercase letter,1 lowercase letter and 1 number" data-parsley-minlength="5"  data-parsley-pattern="/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8,})$/"></td>
				<td><span class="error">*</span><td>
			</tr>
	</script>
			<tr>
				<td>Profile Picture</td>
				<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
				<td><input name="userfile" type="file" id="files" required=""/></td>
				<td><span class="error">*</span></td>
			</tr>
				<tr><img id="imagepreview"></tr>
		</table>
		<br><br><br>
	<button type="submit" name="submit" value="validate" >Submit</button>
	</form>
	<p style="position:absolute;bottom:0;left:45%">Made with <span style="font-size:150%;color:red;">&hearts;</span> by Nandhini</p>
<script  src="scripts/validation.js" type="text/javascript" >
    </script>
	<script type="text/javascript">
$(function () {
  $('#fields').parsley().on('field:validated', function() {
    var ok = $('.parsley-error').length === 0;
    $('.bs-callout-warning').toggleClass('hidden', ok);
  })
});
</script>
</body>
</html>
