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
$qid=$_GET['id'];
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
<?php
    $query = "SELECT * FROM questions WHERE questionid =".$qid.";";
    global $con;
    $ques_list=NULL;
    $ques_list = mysql_query($query, $con);
    $row=mysql_fetch_array($ques_list);
    echo "<div><h3>".$row['question']."</h3><br/><p>".$row['clarification']."</p></div>";
   

?>

</body>

