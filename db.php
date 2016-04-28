<?php
		include 'info.php';
		$mysqli = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
if(mysqli_connect_errorno())
{
	prinf("connect failed:%s\n",mysqli_connect_error());
	exit();

}
else
{
	$sql = "select ";
	$res = mysqli_query($mysqli,$sql);
	if($res)
	{
	}
	mysqli_free_result($res);
	mysqli_close($mysqli);
}
?>

