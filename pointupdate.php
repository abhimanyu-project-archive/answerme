<?
include 'connect_db.php';
$id=$_GET['id'];
$side=$_GET['side'];
$type=$_GET['type'];
$qid=$_GET['qid'];
$points=0;
global $con;
$questionquery="SELECT * FROM questions where questionid='".$qid"';";
$questionswer = mysql_query($query, $con);
if($row=mysql_fetch_array($query_answer))
{
	$tag[1]=$row['tag1'];
	$tag[2]=$row['tag2'];
	$tag[3]=$row['tag3'];	
	if($type=="ques")
	{	
		$up=$row['up'];
		$down=$row['down'];
		$user=$row['username'];
		if($side=='up')
		{
			$up=$up+1;
			$points=2;
		}
		else
		{
			$down=$down+1;
			$points=-1;
		}
	
	$action="UPDATE questions SET (up=".$up",down=".$down") WHERE questionid='".$id."';";
	$actionreply = mysql_query($query, $con);
	}
	else
	{
		$query="SELECT * FROM ques_".$qid." WHERE answerid='".$id"';";
       		$queryanswer = mysql_query($query, $con);
		if($row=mysql_fetch_array($query_answer))
		{
		$up=$row['up'];
		$down=$row['down'];
 		$user=$row['username'];
		if($side=='up')
		{
			$up=$up+1;
			$points=2;
		}
		else
		{
			$down=$down+1;
			$points=-1;
		}
		}
		$action="UPDATE ques_ SET (up=".$up",down=".$down") WHERE answerid='".$id."';";
		$actionreply = mysql_query($query, $con);     
	}


}

$query="SELECT orepid FROM userinfo WHERE username=".$user;

$ques_list = mysql_query($query, $con);
if($row=mysql_fetch_array($ques_list))
{
	$usid=$row['orepid'];         
}
$ch= curl_init();


$url="http://orep.manyu.in/changerep.php?siteid=".siteid."&sitekey=".sitekey."&usid=".$usid."&tag=".$tag[1]."&points=".$points;
//echo $url;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$answer1=curl_exec($ch);

$url="http://orep.manyu.in/changerep.php?siteid=".siteid."&sitekey=".sitekey."&usid=".$usid."&tag=".$tag[2]."&points=".$points;
//echo $url;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$answer2=curl_exec($ch);

$url="http://orep.manyu.in/changerep.php?siteid=".siteid."&sitekey=".sitekey."&usid=".$usid."&tag=".$tag[3]."&points=".$points;
//echo $url;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$answer3=curl_exec($ch);

curl_close($ch);
if($actionreply)
	echo '.';
?>





