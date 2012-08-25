<?php 
session_start();
if (isset($_SESSION['userid']))
{
	$userid=$_SESSION['userid'];
}
else
{
	 header( 'Location: login.php' ); 
}



require_once ('connect_db.php');

?>
<html>
<head>
<title>Answer Me</title>
 <link href="css/main.css" rel="stylesheet">
</head>
<body>
<div class="boxy shadow" id="logo"> 
<h1 class="title">Answer Me !</h1>
</div>
</body>

