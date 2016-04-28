<?php
session_start();
if($_SESSION['user'] == NULL)
{
	header("Location:login.php");
}
		include 'info.php';
		$mysqli = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
if(mysqli_connect_errno())
{
	pritnf("connection failed:%s\n",mysqli_connect_error());
	exit();
}
$sql = "SELECT BOOK_NAME,AUTHOR,NO_OF_CPY  FROM BOOK_DB WHERE ISBN_NO = '".$_POST['issue']."'";
$res = mysqli_query($mysqli,$sql);
if($res)
{
	$noofrows = mysqli_num_rows($res);
	if($noofrows == 0)
	{

		echo "<script> alert(\"data not fount\") </script>";
		exit();
	}
	$array = mysqli_fetch_array($res,MYSQLI_ASSOC);
	$title = $array['BOOK_NAME'];
	$author = $array['AUTHOR'];
	echo "<form action = \"issue2.php\" method = \"post\">";
	echo "TITLE: <input type = \"text\" size = \"25\"  name = \"title\" value = \"".$title."\"><br/>";
	echo "<br/>";
	echo "AUTHOR:<input type = \"text\" size = \"25\" name = \"author\" value = \"".$author."\"><br/>";
	echo "<br/>";
	
	echo "ROLLNO <input type = \"text\" size = \"25\" name = \"rollno\">";
	echo "<br/>";
	echo "<br/>";
	echo "DURATION <input type = \"text\" size = \"5\" name = \"duration\" value = \"7\">";
	echo "<br/>";
	echo "<input type = \"hidden\" name = \"isbn\"  value = \"".$_POST['issue']."\">";
	echo "<br/>";
	echo "<br/>";

	echo "<input type = \"submit\" name = \"submit\">";

	echo "</form>";
}
?>
<html>
<head>
<link rel = "STYLESHEET" type ="text/css" href = "hhh.css" />
</head>
</html>

