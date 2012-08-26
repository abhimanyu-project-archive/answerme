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
<div class="boxy shadow" id="ORep">
<h2 class="title">
<?php 
if (isset($_SESSION['orepid']))
{
$orepid=$_SESSION['orepid'];
$ch= curl_init();
$url="http://orep.manyu.in/changerep.php?siteid=".siteid."&sitekey=".sitekey."&usid=".$orepid;
//echo $url;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$answer=curl_exec($ch);
curl_close($ch);
$obj=json_decode($answer,true);
if ($obj['result']=='Y')
{
	$orepglobal=$obj['global'];
	$oreplocal=$obj['mysite'];
	
	echo "Orep Global :".$orepglobal." Orep AnswerMe :".$oreplocal;
}
else
{
	echo "Site lost authenticity";
}
}
else
{
echo "<a href='orepreg.php' target='_blank'>Connect with ORep</a>";
}
?>
</h2>
</div>

<?php
    $query = "SELECT questionid,question FROM questions ;";
    global $con;
    $ques_list=NULL;
    $ques_list = mysql_query($query, $con);
    while($row=mysql_fetch_array($ques_list))
    {
         echo "<a href='showques.php?id=".$row['questionid']."'><div class='boxy shadow'><p>";
         echo $row['question'];
	 echo "</p></div></a>";
   }

?>

</body>

