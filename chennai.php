<html>
<head>
	<title>Chennai</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.js'></script>
	<link href='https://api.mapbox.com/mapbox.js/v2.4.0/mapbox.css' rel='stylesheet' />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src='scripts/chennai-home.js'></script>
	<link rel='stylesheet' type='text/css' href='css\chennai.css'>
</head>
<body onload='getLocation();'>
	<?php
	session_start();
	if(isset($_SESSION['user'])==1)
	{
		?><style>#signin{display:none;}#user{display:block;}</style><?php
	}
	else
	{	
		$flag=0;
		?><style>#signin{display:block;}</style><?php
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
					?><style>#user{display:block;}#signin{display:none;}</style>
					<?php
					header('Loction:profile.php');
				}
			}
		if($flag==0){
		echo "Invalid login credentials";
		}
		}	
	}

?>
	<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
	  <li data-target="#myCarousel" data-slide-to="4"></li>
	  <li data-target="#myCarousel" data-slide-to="5"></li>
	  <li data-target="#myCarousel" data-slide-to="6"></li>
	  <li data-target="#myCarousel" data-slide-to="7"></li>
	  <li data-target="#myCarousel" data-slide-to="8"></li>
	  <li data-target="#myCarousel" data-slide-to="9"></li>
	  <li data-target="#myCarousel" data-slide-to="10"></li>
	  <li data-target="#myCarousel" data-slide-to="11"></li>
	  <li data-target="#myCarousel" data-slide-to="12"></li>
	  <li data-target="#myCarousel" data-slide-to="13"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="Images\airport.jpg" width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3 style='color:white'>Airport</h3>
            </div>
        </div>
      </div>

      <div class="item">
        <img src="Images\central.jpg" alt="Chennai Central" width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3>Chennai Central</h3>
            </div>
        </div>
      </div>
    
      <div class="item">
        <img src="Images\CMBT.jpg"  width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3>CMBT</h3>
            </div>
        </div>
      </div>

      <div class="item">
        <img src="Images\fort.jpg"  width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3>Fort St.George</h3>
            </div>
        </div>
      </div>
	  <div class="item">
        <img src="Images\vandaloor.jpg"  width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3>Vandaloor Zoo</h3>
            </div>
        </div>
      </div>
	  <div class="item">
        <img src="Images\valluvar-kottam.jpg" width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3>Valluvar kottam</h3>
            </div>
        </div>
      </div>
	  <div class="item">
        <img src="Images\marina.jpg"  width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3>Marina Beach</h3>
            </div>
        </div>
      </div>
	  <div class="item">
        <img src="Images\puzhal.jpg" width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3>Puzhal</h3>
            </div>
        </div>
      </div>
	  <div class="item">
        <img src="Images\semmozhi-poonga.jpg"  width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3 style='position:relative;left:-15px'>Semmozhi Poonga</h3>
            </div>
        </div>
      </div>
	  <div class="item">
        <img src="Images\museum.jpg"  width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3 style='position:relative;left:-15px'>Chennai Museum</h3>
            </div>
        </div>
      </div>
	  <div class="item">
        <img src="Images\library.jpg"  width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3>Library</h3>
            </div>
        </div>
      </div>
	  <div class="item">
        <img src="Images\mahabalipuram.jpg" width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3 style='position:relative;left:-15px'>Mahabalipuram</h3>
            </div>
        </div>
      </div>
	  <div class="item">
        <img src="Images\birla.jpg"  width="460" height="345">
		<div class="absolute-div">
            <div class="carousel-caption">
                <h3 style='position:relative;left:-15px'>Birla Planetorium</h3>
            </div>
        </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<div class='menu'>
<ul>
	<li id='category'><a href='viewCategory.php?categoryId=4d4b7104d754a06370d81259&name=Arts and Entertainment'>Arts and Entertainment</a></li>
	<li id='category'><a href='viewCategory.php?categoryId=4d4b7105d754a06372d81259&name=College and University'>College and University</a></li>
	<li id='category' style='padding-top:4rem'><a href='viewCategory.php?categoryId=4d4b7105d754a06373d81259&name=Events'>Events</a></li>
	<li id='category' style='padding-top:4rem'><a href='viewCategory.php?categoryId=4d4b7105d754a06374d81259&name=Food'>Food</a></li>
	<li id='category' style='padding-top:4rem'><a href='viewCategory.php?categoryId=4d4b7105d754a06376d81259&name=Night Life spots'>Night Life Spot</a></li>
</ul>
</div>
<div class='right-menu'>
<ul>
	<li id='category'><a href='viewCategory.php?categoryId=4d4b7105d754a06377d81259&name=Outdoors and Recreation'>Outdoors and Recreation</a></li>
	<li id='category' style='padding-top:2rem'><a href='viewCategory.php?categoryId=4d4b7105d754a06375d81259&name=Professional and other Places'>Professional and other places</a></li>
	<li id='category' style='padding-top:4rem'><a href='viewCategory.php?categoryId=4e67e38e036454776db1fb3a&name=Residence'>Residence</a></li>
	<li id='category'><a href='viewCategory.php?categoryId=4d4b7105d754a06378d81259&name=Shops and Services'>Shops and Services</a></li>
	<li id='category'><a href='viewCategory.php?categoryId=4d4b7105d754a06379d81259&name=Travel and Transport'>Travel and Transport</a></li>
<ul>
</div>
<div id='signin'>
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
<div id='user'>
	Welcome <?php if(isset($_SESSION['user'])) echo $_SESSION["user"] ?>
	<button class='btn btn-primary' onClick='logout();'><span class='glyphicon glyphicon-log-out'></span></button>
	<br><a href='profile.php'>View your profile</a>
</div>
<div id='map-holder'>
<div id='map' style='height:380px;width:500px;position:relative;left:100px;'></div>
</div>
<script>
function logout()
{
	location.href='logout.php';
}

</script>
</body>
	