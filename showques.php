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
<?php
   $qid=$_GET['id'];  
   $query = "SELECT * FROM questions WHERE questionid ='".$qid."';";
    global $con;
    $ques_list=NULL;
    $ques_list = mysql_query($query, $con);
    $row=mysql_fetch_array($ques_list);
    echo "<div class='boxy'>
          <div class='vote shadow'><a href='#' class='up ques vt' data-rel='".$row['questionid']."'>".$row['up']."</a><br/><a href='#' class='down ques vt' data-rel='".$row['questionid']."'>".$row['down']."</a></div>
          <div class='qa shadow'>
          <h3>".$row['question']."</h3>
         <p>".$row['clarification']."</p>
         </div>
         </div>";
    echo "<div class='boxy shadow'>
          <p>By ".$row['username']." Tagged :".$row['tag1'].",".$row['tag2'].",".$row['tag3']."</div>";
    $query="SELECT * FROM ques_".$qid.";";
    global $con;
   $ans_list=mysql_query($query, $con);
   while($row=mysql_fetch_array($ans_list))
   {
   echo "<div class='boxy'>
          <div class='vote shadow'><a href='#' class='up ans vt' data-rel='".$row['answerid']."'>".$row['up']."</a><br/><a href='#' class='down ans vt' data-rel='".$row['answerid']."'>".$row['down']."</a></div>
          <div class='qa shadow'>
          <h3>".$row['username']." says</h3>
         <p>".$row['anser']."</p>
         </div>
         </div>";
  }

   

?>

</body>

<script src="http://yui.yahooapis.com/3.6.0/build/yui/yui-min.js"></script>
<script>
var request;
var cur;
YUI().use('node','io','event', function (Y) {
   Y.all('.vt').on('click',function(e){
   var qid='abcdefghijklmnopqrstuvwxyzabcd';
   var dr=e.target.getAttribute("data-rel");
   if (e.target.hasClass('ques'))
   {	var type="ques";   }
   else
   {    var type="ans";    }

    if (e.target.hasClass('up'))
   {	var side="up";   }
   else
   {    var side="down";    }
   var uri = "http://answerme.manyu.in/pointupdate.php?type="+type+"&side="+side+"&id="+dr+"&qid="+qid;
   alert(uri);   
   function complete(id, o, args) {
        cur =parseInt(e.target.get("innerHTML"));
	cur=cur+1;
	e.target.set("innerHTML",cur);
   };

  Y.on('io:complete', complete, Y);
  request = Y.io(uri);  
//alert(dr);   
  });
});

</script>
</html>

