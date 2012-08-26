<?
include 'connect_db.php';
$username=$_GET['username'];
$tag=$_GET['tag'];
$points=$_GET['points'];
$query="SELECT orepid FROM userinfo WHERE username=".$username;
global $con;
$ques_list=NULL;
$ques_list = mysql_query($query, $con);
if$row=mysql_fetch_array($ques_list))
{
	$usid=$row['orepid'];         
}
$ch= curl_init();
$url="http://orep.manyu.in/changerep.php?siteid=".siteid."&sitekey=".sitekey."&usid=".$usid."&tag=".$tag."&points=".$points;
//echo $url;
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$answer=curl_exec($ch);
curl_close($ch);
echo $answer;
?>





