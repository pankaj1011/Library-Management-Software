<?php
session_start();
if($_SESSION['user'] == NULL)
{
	header("Location:login.php");
}
if(isset($_POST['old_password']) and isset($_POST['new_password']) and isset($_POST['reenter_password']))
{
	if(!empty($_POST['old_password']) and !empty($_POST['new_password']) and !empty($_POST['reenter_password']))
	{
		if($_POST['new_password'] == $_POST['reenter_password'])
		{
			include 'info.php';
			$mysqli = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
			if(mysqli_connect_errno())
			{
				printf("connection failed: %s\n",mysqli_connect_error());
				exit();
			}
			else
			{
				$sql = "UPDATE ADMIN_TBL SET PASSWORD = '".md5($_POST['new_password'])."' WHERE PASSWORD = '".md5($_POST['old_password'])."' AND LOGIN = '".$_SESSION['user']."'";
				$res = mysqli_query($mysqli,$sql);
				$tmp2 = mysqli_affected_rows($mysqli);
				if($res == TRUE && $tmp2 == 1)
				{
					$message = "password changed.";
					echo "<script>";
					echo "alert(\"".$message."\")";
					echo "</script>";
				}
				else
				{
					echo "<script> alert(\"Password not changed\") </script>";
				}
			}
			mysqli_close($mysqli);

		}
		else
		{
			$message = "password not match";
			echo "<script>";
			echo "alert(\"".$message."\")";
			echo "</script>";
		}
	}




	else
	{
		$message = "all are mandatory.";
		echo "<script>";
		echo "alert(\"".$message."\")";
		echo "</script>";
	}

}



?>


<html>
<head>
<title>registration form</title>
<link rel = "STYLESHEET" type ="text/css" href = "hhh.css" />
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<p><label for="old_password">OLD_PASSWORD</label><br/>
	<input type="password" size="25" id="old_password" name="old_password"/></p>
	<p><label for="new_password">NEW PASSWORD</label><br/>
	<input type="password" size="25" id="new_password" name="new_password"/></p>
	<p><label for="reenter_password">RE-ENTER PASSWORD</label><br/>
	<input type="password" size="25" id="reenter_password" name="reenter_password"/></p>
	<button type="submit" name="submit" value="send">Submit</button>
</form>
</body>
</html>
