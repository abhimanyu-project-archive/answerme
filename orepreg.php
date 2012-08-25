<?php
session_start();
include 'connect_db.php';
if (!(isset($_SESSION['userid'])))
{
	header( 'Location: login.php' ); 
}
$ch= curl_init();
$url="http://orep.manyu.in/getsessionkey.php?siteid=".siteid."&sitekey=".sitekey;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$answer=curl_exec($ch);
curl_close($ch);
$obj=json_decode($answer,true);
if ($obj['res']==false)
{
header( 'Location: index.php' ); 
}
else
{
$ssid=$obj['ssid'];
header( 'Location: http://orep.manyu.in/login.php?ssid='.$ssid ); 
}
?>


