<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700italic' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' type='text/css' href='css/profile.css'>
	<script>
		window.addEventListener("click",function(e){
														document.getElementById("output").style.display="none";
													});
	</script>
</head>
<body>
	<?php 
		global $row;
		$row= new StdClass;
		$row->id = null;
		$row->pass = "";
		$row->image="";
		$row->phno="";
		$row->gender="";
		$row->email="";
		$row->name="";
		session_start();
		if(!isset($_SESSION['user']))
			header('Location:chennai.php');
		else
		{
		include "connect.php";
		$sql=$conn->prepare("SELECT username,name,passcode,Image,email,phno,gender from users where username=?");
		$sql->bind_param('s',$_SESSION['user']);
		$sql->execute();
		$sql->store_result();
		$sql->bind_result($row->id,$row->name,$row->pass,$row->image,$row->email,$row->phno,$row->gender);
		$sql->fetch();
		}
	?>
	<nav class="navbar navbar-full navbar-dark bg-primary">
  <a class="navbar-brand"  href="#">Chennai Daw</a>
  <ul class="nav navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="chennai.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Add checkin</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="profile.php">Your Profile</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="friends.php">Friends</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Notifications</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="#" onClick='viewRequest();return false;'>Friend requests</a>
    </li>
	<li class="nav-item pull-xs-right">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
  </ul>
  <form class="form-inline">
    <span class='glyphicon glyphicon-search'></span>
  <input class='form-control' onkeyup="findmatch();" type="text"  data-toggle="tooltip" data-placement="right" title="Enter username or Phone number"
  id="search" placeholder="Search with username or Phone Number" style='width:300px'></p>
  </form>

</nav>
  
	
  <div id="img-holder">
<?php
include "connect.php";
echo '<img id="dp" src="data:image/jpeg;base64,'.base64_encode( $row->image ).'"/>';
?>
<button class="btn btn-info" id="Edit" onClick="updatedp();">
          <span class="glyphicon glyphicon-pencil"></span>
</button>
</div>
   
<div  id="output">
	
	</div>
<div id="id01" class="modal">
	
	<div class="modal-content" id="change">
		</div>
	</div>	
<div id="contents">
	<h1 style="position:relative;left:25px;top:30px">Contact Information</h1><br>
	<hr color="black">
	<table>
		<div id="name">
		<tr>
			<td width="30%">Name</td>
			<td width="40%" id="valueName"><?php echo $row->name;?></td>
			<td width="20%"><button type="button" class="btn btn-default" onclick="updatename();"><span class="glyphicon glyphicon-pencil icon-success"></span> Edit</button></td>
		</tr>
		</div>
		<div id="gender">
		<tr>
			<td>Gender</td>
			<td id="valueGender"><?php echo $row->gender;?></td>
			<td><button type="button" class="btn btn-default" onclick="updategender();"><span class="glyphicon glyphicon-pencil icon-success"></span> Edit</button></td>
		</tr>
		</div>
		<div id="email">
		<tr>
			<td>Email</td>
			<td id="valueEmail"><?php echo $row->email;?></td>
			<td><button type="button" class="btn btn-default" onclick="updatemail();"><span class="glyphicon glyphicon-pencil icon-success"></span> Edit</button></td>
		</tr>
		</div>
		<div id="phno">
		<tr>
			<td>Phone number</td>
			<td id="valuePhno"><?php echo $row->phno; ?></td>
			<td><button type="button" class="btn btn-default" onclick="updatephno();"><span class="glyphicon glyphicon-pencil icon-success"></span> Edit</button></td>
		</tr>
		</div>
	</table>
	<br>
		<button align="center" style="position:relative;left:25%" onclick="updatepassword();">Change Password</button>
	<br>
	<br><br><br><br>
	<p style="position:absolute;bottom:0;left:25%;font-size:15px">Made with <span style="font-size:150%;color:red;">&hearts;</span> by Nandhini</p>
</div>
<div id='requests' style='display:table;margin:0 auto'></div>
<script>
var param="";
	function viewRequest()
	{
		$('#contents').hide();
		$('#img-holder').hide();
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				$("#requests").append(xmlhttp.responseText);
			}
		}
		xmlhttp.open('GET','getrequest.php',true);
		xmlhttp.send();
	}
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
	function updatename()
	{
		param="Name";
		document.getElementById("name").style.display="none";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';><span class='glyphicon glyphicon-remove'></span></button><center><table><tr><td>Enter Name:</td><td><input type='text' id='changedvalue' autofocus></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	function updategender()
	{
		param="Gender";
		document.getElementById("gender").style.display="none";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';><span class='glyphicon glyphicon-remove'></span></button><center><table><tr><td>Gender:</td><td><input type='text' id='changedvalue' autofocus></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	function updatemail()
	{
		param="Email";
		document.getElementById("email").style.display="none";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';><span class='glyphicon glyphicon-remove'></span></button><center><table><tr><td>Email Id:</td><td><input type='email' id='changedvalue' autofocus></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	function updatephno()
	{
		param="Phno";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';><span class='glyphicon glyphicon-remove'></span></button><center><table><tr><td>Phone Number:</td><td><input type='text' id='changedvalue' autofocus></td><td><button onclick='send()'>Submit</button></td></tr></table></center>";
	}
	function updatedp()
	{
		alert("called");
		param="Image";
		var modal=document.getElementById("id01");
		modal.style.display="block";
		document.getElementById("change").innerHTML="<button onclick=document.getElementById('id01').style.display='none';><span class='glyphicon glyphicon-remove'></span></button><center><form enctype='multipart/form-data' action='upload.php' method='post'><table><tr><td>Profile Picture</td><td><input type='file' id='changedvalue' name='userfile'></td><td><button type='submit' name='submit' value='Submit'>Submit</button></td></tr></table></form></center>";
	}
	function updatepassword() {
		var modal=document.getElementById("id01");
		modal.style.display="block";
		var text="<button onclick=document.getElementById('id01').style.display='none';><span class='glyphicon glyphicon-remove'></span></button><center>";
		text+="<table><tr><td>Enter old Password:</td><td><input type='password' name='oldpass' id='oldpass' autofocus></td></tr>";
		text+="<tr><td>Enter New Password:</td><td><input type='password' name='newpass' id='newpass'></td></tr>";
		text+="<tr><td>Confirm New Password:</td><td><input type='password' name='confirmpass' id='confirmpass'></td></tr>";
		text+="<tr><td></td><td><button onclick='AjaxChangePass();'>Submit</button>";
		document.getElementById("change").innerHTML=text;
	}
	function AjaxChangePass(){
		var xmlHttp = new XMLHttpRequest();
		var url="updatepassword.php";
		var parameters = "oldpass="+document.getElementById('oldpass').value+"&newpass="+document.getElementById('newpass').value+"&confirmpass="+document.getElementById('confirmpass').value;
		xmlHttp.open("POST", url, true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.setRequestHeader("Content-length", parameters.length);
		xmlHttp.setRequestHeader("Connection", "close");
		xmlHttp.onreadystatechange = function() {
			if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			alert(xmlHttp.responseText);
			if(xmlHttp.responseText=="Success.Please Login again")
				{
				document.location.href='index.php';
			document.getElementById("id01").style.display="none";
				}
			
		}
	}
		xmlHttp.send(parameters);
	}
	function send()
	{
		var newvalue=document.getElementById("changedvalue").value;
		var renumber=/[0-9]/;
		var iChars = "!@#$%^&*()+=-[]\';,./{}|\":<>?~_";
		var relower=/[a-z]/;
		var reupper=/[A-Z]/;
		if(param=="Name")
		{
			for (var i = 0; i < newvalue.length; i++) 
			{
				if (iChars.indexOf(newvalue.charAt(i)) != -1) {
				alert ("Your string has special characters.These are not allowed.");
				return false;
				}
			}
			if(renumber.test(newvalue))
			{
				alert("Name Can only contain letters and spaces");
				return;
			}
		}
		else if(param=="Gender")
		{
			if(newvalue!="M" && newvalue!="F")
				{
					alert("Gender can be only M/F :M - Male F-Female");
					return;
				}
		}
		else if(param=="Phno")
		{
			if(newvalue.length<8 || relower.test(newvalue) ||reupper.test(newvalue) )
			{
				alert("Enter valid phone number");
				return;
			}
		}
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
			if(xhttp.responseText=="Given Email/Phone number is already taken")
			{
				alert("Given Email id/Phone number is already taken");
				return;
			}
		document.getElementById("value"+param).innerHTML=xhttp.responseText;
		document.getElementById("id01").style.display="none";
		}
		};
		xhttp.open("GET", "update.php?"+param+"="+newvalue, true);
		xhttp.send();
	}
	
</script>

</body>
</html>