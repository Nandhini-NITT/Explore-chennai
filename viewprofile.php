<html>
	<head>
	<title><?php echo $_GET['username']; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/profile.css">
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700italic' rel='stylesheet' type='text/css'>
	</head>
	<body>
	<?php
	session_start();
	if(isset($_SESSION['user'])==1)
	{
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
	<li class="nav-item">
      <a class="nav-link" href="search.html">Search in all categories</a>
    </li>
	<li class="nav-item pull-xs-right">
	<?php 
	if(isset($_SESSION['user']))
			echo '<a class="nav-link" href="logout.php">Logout</a>';
	else
		echo '<a class="nav-link" href="login.php">Login</a>';
	?>
    </li>
  </ul>
  <form class="form-inline">
    <span class='glyphicon glyphicon-search'></span>
  <input class='form-control' onkeyup="findmatch();" type="text"  data-toggle="tooltip" data-placement="right" title="Enter username or Phone number"
  id="search" placeholder="Search with username or Phone Number" style='width:300px'></p>
  </form>

</nav>
<div  id="output">
</div>
  <div id="img-holder">
<?php
include "connect.php";
echo '<img id="dp" src="data:image/jpeg;base64,'.base64_encode( $row1['Image'] ).'"/>';
?>
</div>
<div id='requests'></div>
<div id="contents">
	<h1 style="position:relative;left:25px;top:30%">Contact Information</h1>
	<div id='addFriend'>
	
	</div>
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
	<hr>
	<a href='#' onClick="$('#reviews').show();$('#ReviewLink').remove();load_review();return false;" id='ReviewLink'>Reviews submitted By <?php echo $_GET['username']; ?>&nbsp <span class='glyphicon glyphicon-chevron-down'></span></a>
	<div id='reviews' style='display:none;'>
		<div id='header'>
			<h3>Reviews</h3>
		</div>
		<div id='ReviewBody'>
		</div>
	</div>
	<a href='#' onClick="$('#checkins').show();$('#CheckinLink').remove();load_checkins();return false;" id='CheckinLink'>Checkins By <?php echo $_GET['username']; ?>&nbsp <span class='glyphicon glyphicon-chevron-down'></span></a>
	<div id='checkins' style='display:none;'>
		<div id='header'>
			<h3>Checkin</h3>
		</div>
		<div id='CheckinBody'>
		</div>
	</div>
	<br><br><br><br>
	<p style="position:relative;bottom:0;left:25%;font-size:15px">Made with <span style="font-size:150%;color:red;">&hearts;</span> by Nandhini</p>
</div>

	<script>
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
		window.onload=function(){
				updatebutton();
				};
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
	function deleteRequest(){
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				alert(xmlhttp.responseText);
				updatebutton();
				$('#ReviewBody').empty();
				load_review();
			}
		}
		xmlhttp.open('GET','removeFriend.php?id='+getParameterByName('username'),true);
		xmlhttp.send();
	}
	function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
		function updatebutton()
		{
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				$('#addFriend').html(xmlhttp.responseText);
			}
		}
		xmlhttp.open('GET','updatebutton.php?id='+getParameterByName('username'),true);
		xmlhttp.send();
		}
	function acceptRequest()
	{
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				alert(xmlhttp.responseText);
				updatebutton();
			}
		}
		xmlhttp.open('GET','accept.php?id='+getParameterByName('username'),true);
		xmlhttp.send();
	}
	function sendRequest()
	{
		var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				alert(xmlhttp.responseText);
				updatebutton();
			}
		}
		xmlhttp.open('GET','addFriend.php?id='+getParameterByName('username'),true);
		xmlhttp.send();
	}
	function load_review()
	{
		var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				$('#ReviewBody').append(xmlhttp.responseText);
				var control=0,pointer=0;
				while(document.getElementById('venue'+control)!=null)
				{
					var venueId=document.getElementById('venue'+control).innerHTML;
					var url='https://api.foursquare.com/v2/venues/'+venueId+'?v=20150214&client_secret=T4YM5HKKRQCM1T1KQJPBMHDGPVTVBA1N3ID3NMCHIYNQDI2Q&client_id=10C4S0MMP2ZCTX3ACXKZ3YUSCGZXCOTXLTTOI2WVJ3WTIMH1';
					console.log(url);
					$.ajax(url,{
							complete:function(xmlhttp,status){
							var oData=$.parseJSON(xmlhttp.responseText);
							console.log(oData);
							document.getElementById('venue'+pointer).innerHTML='<p><a href="viewVenue.php?id='+venueId+'">'+oData.response.venue.name+'</a></p>';
							pointer++;
							}
							});
					control++;
				}
			}
		}
		xmlhttp.open('GET','fetchReviewByName.php?id='+getParameterByName('username'),true);
		xmlhttp.send();
	}
	function load_checkin()
	{
		var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				$('#CheckinBody').append(xmlhttp.responseText);
			}
		}
		xmlhttp.open('GET','viewUserCheckins.php?name='+getParameterByName('username'),true);
		xmlhttp.send();
	}

	</script>
	</body>
</html>