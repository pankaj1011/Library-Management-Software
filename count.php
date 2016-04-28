<?php
		include 'info.php';
		$mysqli = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
 if(mysqli_connect_errno())
 {
	 printf("connection failed: %s\n",mysqli_coonect_error());
	 exit();
 }
 else
 {
	 $sql1 ="CALL COUNT_BOOKS(@OUT)";
	 $RES = mysqli_query($mysqli,$sql1);
	 $sql = "SELECT @OUT";
	 $RES = mysqli_query($mysqli,$sql);
	 $array = mysqli_fetch_array($RES,MYSQLI_ASSOC);

	 printf("%d", $array['@OUT']);
 }
 mysqli_close($mysqli);
?>
<html>
<head>
<link rel = "STYLESHEET" type ="text/css" href = "hhh.css" />
</head>
</html>
