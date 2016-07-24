<html>
<head>
	<title>Venue</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
	<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700italic' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' type='text/css' href='css/viewVenue.css'>
	<script src='scripts/viewVenue.js'></script>
	<link rel='stylesheet' type='text/css' href='css/rating.css'>
	<script src='scripts/rating.js'></script>
</head>
<body onload='start();'>
<script>
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
	}
</script>
<?php
	session_start();
	include "connect.php";
	if(isset($_SESSION['user'])==1)
	{
		?><style>#login{display:none;}</style><?php
}
	else
	{	
		$flag=0;
		?><style>#login{display:block;}</style><?php
		if($_SERVER['REQUEST_METHOD']=="POST" )
		{
			include "connect.php";
			$user=$_POST["uname"];
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
					?><style>#login{display:none;}#addReview{display:block;}</style>
					<?php
				}
			}
		if($flag==0){
		?><script>alert("Invalid login credentials");</script>
		<?php
		}
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
      <a class="nav-link" href="search.html">Add checkin</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="profile.php">Your Profile</a>
    </li>
	<li class="nav-item">
      <a class="nav-link" href="#" onClick='display_Friends();return false;'>Friends</a>
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
<div id='output'>
</div>
<div id='contents'>
<span id='name'>Title</span>
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Signin</button>
	<span id='category'></span>
	<span id='categoryIcon'></span>
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
		<ol class="carousel-indicators">
		</ol>
		<div class="carousel-inner" role="listbox">
		</div>
	  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
		</a>
	</div>
	<br>
	<p style='display:table;margin:0 auto'>Click on the marker to know the address of location</p>
	<div id='map' style='height:300px;display:table;margin:0 auto;width:500px'>
	</div>
<div id='frame' style='overflow-y:auto'>
<p>Reviews from users</p>
<div id='addReview'>
		  <textarea rows='4' cols='50' id='review' required>
			</textarea>
			<br>
			<select class="form-control" id='visibility'>
				<option>Public</option>
				<option>Only Friends</option>
			</select>
			Post as Anonymous &nbsp <input type='checkbox' value="Anonymous" id='anonymous'>
			<br>
			<br>
			<?php if(!isset($_SESSION['user'])){
				?><style>#visibility{display:none;}#anonymous{display:none;}</style><?php 
				}
				?>
				<button class='btn btn-primary' onClick='add();' >Submit</button>
			</div>
		<br>
	</div>
	<!--<div class="modal fade" id="confirm" role="dialog">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Confirm</h4>
        </div>
        <div class="modal-body">
		<p>Your review will be posted as anonymous.Do you want to continue.</p>
		<button class='btn btn-primary'>Yes</button>
		<button class='btn btn-danger' onClick='function(){>No</button>-->
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Signin</h4>
        </div>
        <div class="modal-body">
		  <div id='login'>
			<form action="" method="post"  id="signin">
				SIGNIN<br>
				Username or Phone number:
				<input type="text" name="uname">
				<br>
				Password:
					<input type="password" name="password">
				<button type="submit" name="submit" value="Submit" type='submit'>Submit</button>
			Not registered yet?? <a href='adduser.php'>Signup</a>
			<p>or</p>
			</form>
		</div>
		</div>
		</div>
		</div>
		</div>
  <div id='requests' style='display:table;margin:0 auto'></div>
<div id='friends'></div>
  <script>
		
			/*$('.modal-title').text("View Review");
			var stars=function(){
			var el = document.querySelector('#star');
			var currentRating = 0;
			if($row1!==undefined)
			{
			var star=<?php echo $row1["star"]; ?>;
			for(var i=0;i<star;i++)
			{
				$('#star').append("<span style='color:gold;size:40%;display:inline-block;font-size:30px'>&#9733;</span>");
			}
			}
			};
			
			var displayStar=new stars();*/
		function display_Friends()
	{
		$('#friends').empty();
		$('#contents').hide();
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function(){
			if(xmlhttp.readyState == 4 &&  xmlhttp.status == 200){
				
				$("#friends").append(xmlhttp.responseText);
			}
		}
		xmlhttp.open('GET','friends.php',true);
		xmlhttp.send();
	}
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
	var star;
	function add()
	{
		var anonymous,visibility;
		var usercheck='<?php if(isset($_SESSION['user'])) echo "1"; else echo "0"; ?>';
		if (usercheck==0)
		{
			if(confirm("The review will be posted as anonymous.Do you want to continue?"))
				name='anonymous';
			else
			{
				$('#myModal').modal('show');
				return;
			}
		}
		else
		{
			if(document.getElementById("anonymous").checked)
				anonymous=1;
			else
				anonymous=0;
		}
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		alert(xhttp.responseText);
		$('#myModal').modal('hide');
		location.reload();
		}
		};
		if(document.getElementById("visibility").style.display=='none')
			visibility="Public";
		else
			visibility=document.getElementById("visibility").value;
		if(name==="anonymous" || anonymous==1)
			xhttp.open("GET","addAnonymousReview.php?id="+getParameterByName('id')+"&stars="+star+"&review="+document.getElementById('review').value, true)
		else
			xhttp.open("GET", "addReview.php?id="+getParameterByName('id')+"&visibility="+visibility+"&stars="+star+"&review="+document.getElementById('review').value, true);
		xhttp.send();
	}
	var el = document.querySelector('#addReview');
// current rating, or initial rating
var currentRating = 0;
// max rating, i.e. number of stars you want
var maxRating= 5;
// callback to run after setting the rating
var callback = function(rating) { star=rating; };
// rating instance
var myRating = rating(el, currentRating, maxRating, callback);
</script>
</body>
</html>