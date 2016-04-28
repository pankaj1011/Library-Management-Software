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
	printf("connection failed: %s\n",mysqli_connect_error());
	exit();
}
$sql = "SELECT * FROM STUDENT_REG_TBL WHERE ROLL_NO = '".$_POST['rollno']."'";
$res = mysqli_query($mysqli,$sql);

if($res)
{
	$noofrow = mysqli_num_rows($res);
	if($noofrow == 0)
	{
		echo "<script>alert(\"this rollno is no registered\")</script>";
		exit();
	}
	$array = mysqli_fetch_array($res,MYSQLI_ASSOC);
	$NAME = $array['FULL_NAME'];
	$d = date_create(NULL);
	$d1 = date_format($d,"Y-m-d");
	$days = $_POST['duration'];
	date_add($d, date_interval_create_from_date_string("$days days"));
	$d2 = date_format($d,"Y-m-d");
	$sql = "INSERT INTO ISSUE_DB VALUES ('".$_POST['rollno']."','".$_POST['isbn']."', '".$d1."','".$d2."')";
	$res = mysqli_query($mysqli,$sql);
	if($res == true)
	{
		$sql = "UPDATE BOOK_DB SET NO_OF_CPY = NO_OF_CPY-1 WHERE ISBN_NO = '".$_POST['isbn']."'";
		$res = mysqli_query($mysqli,$sql);
		echo "<script>alert(\"book issued to ".$NAME." \")</script>";
	}
	else
	{
		echo "<script>alert(\"book not issued\")</script>";
	}

}
?>
<html>
<head>
<link rel = "STYLESHEET" type ="text/css" href = "hhh.css" />
</head>
</html>





