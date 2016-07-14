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
	if(isset($_SESSION['user'])==1)
	{
		?><style>#login{display:none;}#addReview{display:block;}</style><?php
	}
	else
	{	
		$flag=0;
		?><style>#login{display:block;}#addReview{display:none;}</style><?php
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
					header('Loction:profile.php');
				}
			}
		if($flag==0){
		?><script>alert("Invalid login credentials");</script>
		<?php
		}
		}	
	}

?>
	
	
<span id='name'>Title</span>
	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Review</button>
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
</div>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Review</h4>
        </div>
        <div class="modal-body">
		  <div id='login'>
			<form action="" method="post"  id="signin">
				<h1 align="center">SIGNIN</h1>
				Username or Phone number:
				<input type="text" name="uname">
				<br>Password:
				<input type="password" name="password">
			<br>
			<button type="submit" name="submit" value="Submit">Submit</button>
			<br>
			Not registered yet?? <a href='adduser.php'>Signup</a>
			</form>
		  </div>
		  <div id='addReview'>
			<textarea rows="4" cols="50" id='review' autofocus>
			</textarea>
			<button class='btn btn-primary' onClick='add();'>Submit</button>
		</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<script>
	function add()
	{
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
		if (xhttp.readyState == 4 && xhttp.status == 200) {
		alert(xhttp.responseText);
		$('#myModal').modal('hide');
		}
		};
		xhttp.open("GET", "addReview.php?id="+getParameterByName('id')+"&review="+document.getElementById('review').value, true);
		xhttp.send();
	}
</script>
</body>
</html>