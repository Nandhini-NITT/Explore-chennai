<html>
<head>
	<title>View Categories</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src='scripts/viewCategory.js'></script>
	<link rel='stylesheet' type='text/css' href='css/viewCategory.css'>
	<style>
		.nav-link ,.navbar-brand{
color:white;
}
	.form-inline
{
position:relative;
top:1rem;
}
	</style>
</head>
<body onload='start();'>
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
	session_start();
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
	<div id='searchInCategory' style='position:relative;left:30%;'><input type='text' style='width:500px'><button id='search' onClick='searchInCategory();'>Submit</button></div>
	<br><br>
	<div id='container'>
		<table id='showResults'>
		<thead>
			<th>Photo</th>
			<th>Venue Id</th>
			<th>Venue Name</th>
		</thead>
		<tbody>
		</tbody>
		</table>
	</div>
	
</body>
</html>