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
$sql = "DELETE FROM ISSUE_DB WHERE ISBN_NO = '".$_POST['return']."'";
$res = mysqli_query($mysqli,$sql);
if($res == true)
{
	$sql = "UPDATE BOOK_DB SET NO_OF_CPY = NO_OF_CPY+1 WHERE ISBN_NO = '".$_POST['return']."'";
	$res = mysqli_query($mysqli,$sql);
	echo "<script>alert(\"book returned \")</script>";
}
else
{
	echo "<script>alert(\"book not returned\")</script>";
}

?>





