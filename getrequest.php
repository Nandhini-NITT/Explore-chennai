<?php
include "connect.php";
session_start();
$sql="Select sender from friendrequest_tray where receiver='".$_SESSION['user']."'";
$stmt=$conn->query($sql);
$control=0;
while($control<$stmt->num_rows)
{
$row=$stmt->fetch_assoc();
echo "<li><a role='menuitem' tabindex='-1' href='viewprofile.php?username=".$row['sender']."'><div id='suggestions'>".$row['sender']."</div></a></li>";
$control++;
}
?>