<?php
session_start();
if($_SESSION['user'] == NULL)
{
	header("Location:login.php");
}

?>



<html>
<head>
<link rel = "STYLESHEET" type ="text/css" href = "hhh.css" />
</head>
<frameset cols ="150,*">
	<frame src ="left.html"name ="left"/>
	<frame src ="right.html" name ="right"/>
</frameset>
</html>
