<?php
if(isset($_POST['rollno']))
{
		include '../info.php';
$mysqli  = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
	if(mysqli_connect_errno())
	{
		printf("connect failed: %s\n",mysqli_connect_error());
		exit();
	}
	else
	{
		$sql = "SELECT ROLL_NO,PASSWORD FROM STUDENT_REG_TBL WHERE ROLL_NO = '".$_POST['rollno']. "' and  PASSWORD = '".md5($_POST['password'])."'";
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
				$_SESSION['user1'] = $_POST['rollno'];
				header("Location:student_main.php");
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
 </head>
 <body>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
		 <p><label for="rollno">ROLLNO:</label><br/>
		 <input type="text" size="25" name="rollno"/></p>
		 <p><label for="password">password:</label><br/>
		 <input type="password" name="password" size="30" ></p>
		 <button type="submit" name="submit" value="send">login</button>
	 </form>
<a href ="../index.html" target ="_top"> Go to HomePage</a><br /><br />

 </body>
 </html>
