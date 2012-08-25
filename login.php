<?php 
session_start();
include 'connect_db.php';
include 'mysql_class.php';
if (isset($_SESSION['userid']))
{
	header( 'Location: index.php' ); 
}
$user=$_POST["username"];
$pass=$_POST["password"];
$pass=md5($pass);
if($user!=NULL && $pass!=NULL)
{
    $qstring = "username='".$user."' AND passwordhash='".$pass."'";
    $query = "SELECT * FROM userinfo WHERE " . $qstring . ";";
    global $con;
    $auth_table = NULL;
    $auth_table = mysql_query($query, $con);

    $size=mysql_num_rows($auth_table);
    if ($size==0)
    {
	 $wrongpass=true;
    }
    else
    {
	$row=mysql_fetch_row($auth_table);
	if ($row['orepid']!="")
	{
		$_SESSION['operid']=$row['orepid']!;
	}	
	$_SESSION['userid']=$user;
	header('Location: index.php');
    }

}


?>
<html>
<head>
<title>Answer Me</title>
 <link href="css/main.css" rel="stylesheet">
</head>
<body>
<div class="boxy shadow" > 
<form id='login' action='login.php' method='post' accept-charset='UTF-8'>
        <fieldset >
                <div id = "loginform" align="center">
                <legend>Login</legend>
		<?php if ($wrongpass) {echo "<em>Wrong username/password </em><br/>";} ?>
                <input type='hidden' name='submitted' id='submitted' value='1'/>
                UserName*: &nbsp <input type='text' name='username' id='username'  maxlength="50"/>
                <br>
                Password*&nbsp&nbsp: &nbsp <input type='password' name='password' id='password' maxlength="50"/>
                <br>
                <input type='submit' name='Submit' value='Submit'/>
                </div>
        </fieldset>
    </form>
</div>
</body>

