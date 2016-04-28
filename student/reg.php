<?php
function validate_email($email)
{
	$ret = strchr($email,"@");
	if($ret == NULL)
	{
		return NULL;
	}
	else
	{
		$ret1 = strchr($ret ,".");
		return $ret1;
	}
}
if(isset($_POST['rollno']) and isset($_POST['name']) and isset($_POST['email']) and isset($_POST['password']))
{
	if(!empty($_POST['rollno']) and !empty($_POST['name']) and !empty($_POST['email']) and !empty($_POST['password']))
	{
		if($_POST['password'] == $_POST['password1'])
		{
			include '../info.php';
			$mysqli = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
			if(mysqli_connect_errno())
			{
				printf("connection failed: %s\n",mysqli_connect_error());
				exit();
			}
			else
			{
				$value = validate_email($_POST['email']);
				if($value == NULL)
				{
					$message = "invalid email.";
					echo "<script>";
					echo "alert(\"".$message."\")";
					echo "</script>";

				}
				else
				{
					$pwrd = $_POST['password'];
					$pwrd = md5($pwrd);
					$sql = "INSERT INTO STUDENT_REG_TBL VALUES('".$_POST['rollno']."','".$_POST['name']."','".$_POST['email']."','$pwrd')";
					$res = mysqli_query($mysqli,$sql);
					if($res == TRUE)
					{
						$message = "record inserted.";
						echo "<script>";
						echo "alert(\"".$message."\")";
						echo "</script>";
					}
				}
				mysqli_close($mysqli);

			}
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
<link rel = "STYLESHEET" type ="text/css" href = "../hhh.css" />
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<p><label for="name">Name:</label><br/>
	<input type="text" size="25" id="name" name="name"/></p>
	<p><label for="rollno">Rollno:</label><br/>
	<input type="text" size="25" id="rollno" name="rollno"/></p>
	<p><label for="email">E-Mail Address:</label><br/>
	<input type="text" size="25" id="email" name="email"/></p>
	<p><label for="password">Password</label><br/>
	<input type="password" size="25" id="password" name="password"/></p>
	<p><label for="password">Re-enter password:</label><br/>
	<input type="password" size="25" id="password1" name="password1"/></p>
	<button type="submit" name="submit" value="send">Submit</button>
</form>
</body>
</html>
