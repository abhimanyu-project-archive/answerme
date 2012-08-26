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
echo "Orep Global :".$orepglobal." Orep AnswerMe :".$oreplocal;
}
else
{
echo "<a href='orepreg.php' target='_blank'>Connect with ORep</a>";
}
?>
<h2>
<?php
    $query = "SELECT questionid,question FROM questions ;";
    global $con;
    $ques_list=NULL;
    $ques_list = mysql_query($query, $con);
    for($row=mysql_fetch_row($queslist))
    {
         echo "<a href='showques.php?id".$row['questionid']."'><div class='boxy shadow'><p>";
         echo $row['question'];
	 echo "</p></div></a>";
   }

?>

</body>

