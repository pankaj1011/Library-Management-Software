<?php
session_start();
if($_SESSION['user'] == NULL)
{
	header("Location:login.php");
}

if(isset($_POST['bookname']) and isset($_POST['author']) and isset( $_POST['isbnno']) and isset($_POST['noofcpy']))
{
	if(!empty($_POST['bookname']) and !empty($_POST['author']) and !empty( $_POST['isbnno']) and !empty($_POST['noofcpy']))
	{
		include 'info.php';
		$mysqli = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
		if(mysqli_connect_errno())
		{
			printf("connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$sql = "SELECT * FROM BOOK_DB WHERE ISBN_NO = '".$_POST['isbnno']."'";
		$res = mysqli_query($mysqli,$sql);
		if($res)
		{
			$row = mysqli_num_rows($res);
			if($row == 0)
			{
				$sql ="INSERT INTO BOOK_DB VALUES('".$_POST['bookname']."','".$_POST['author']."','".$_POST['isbnno']."','".$_POST['noofcpy']."')";
				$res = mysqli_query($mysqli,$sql);

				if($res == TRUE)
				{
					$message = "record inserted.";
					echo "<script>";
					echo "alert(\"".$message."\")";
					echo "</script>";
				}
			}
			else
			{
				$sql = "UPDATE BOOK_DB SET NO_OF_CPY = NO_OF_CPY + ".$_POST['noofcpy']." WHERE ISBN_NO = '".$_POST['isbnno']."'";
				$res = mysqli_query($mysqli,$sql);
				if($res == TRUE)
				{
					$message = "record updated.";
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
		echo "<script>";
		echo "alert(\"all fields are mandatory\")";
		echo "</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>dataentry</title>
<link rel = "STYLESHEET" type ="text/css" href = "hhh.css" />
</head>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
	<p><label for="bookname">BOOK NAME:</label><br/>
	<input type="text" size="25" id="bookname" name="bookname"/></p>
	<p><label for="author">AUTHOR:</label><br/>
	<input type="text" size="25" id="author" name="author"/></p>
	<p><label for="isbnbo">ISBN_NO</label><br/>
	<input type="text" size="10" id="isbnno" name="isbnno"/></p>
	<p><label for="noofcpy">NO_OF_CPY</label><br/>
	<input type="text" size="10" id="noofcpy" name="noofcpy"/></p>
	<button type="submit" name="submit" value="send">Submit</button>
</form>
</body>
</html>

