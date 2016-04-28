<?php
if(isset($_POST['loginid']))
{
	include 'info.php';
	$mysqli = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
	if(mysqli_connect_errno())
	{
		printf("connect failed: %s\n",mysqli_connect_error());
		exit();
	}
	else
	{
		$sql = "SELECT LOGIN,PASSWORD FROM ADMIN_TBL WHERE LOGIN = '".$_POST['loginid']. "' and  PASSWORD = '".md5($_POST['password'])."'";
		$res = mysqli_query($mysqli, $sql);
		if ($res) 
		{
			$number_of_rows = mysqli_num_rows($res);
			if($number_of_rows == 0)
			{
				echo "<script>";
				echo "alert(\"invalid username or password\")";
				echo "</script>";

			}
			else if($number_of_rows == 1)
			{
				session_start();
				$_SESSION['user'] = $_POST['loginid'];
				header("Location:main.php");
			}
			else if($number_of_rows == 2)
			{
				echo "more records.";
			}

		} 
		else
		{
			echo "login unsuccessful.";
		}
		mysqli_close($mysqli);
	}
}
?>

<html>
<head>
<title>login</title>
<link rel = "STYLESHEET" type ="text/css" href = "hhh.css" />
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<p><label for="loginid">login id</label><br/>
	<input type="text" size="25" name="loginid"/></p>
	<p><label for="password">password:</label><br/>
	<input type="password" name="password" size="30" ></p>
	<button type="submit" name="submit" value="send">login</button>
</form>
<a href ="index.html" target ="_top"> Go to HomePage</a><br /><br />
</body>
</html>

