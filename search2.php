<html>
<head>
<link rel = "STYLESHEET" type ="text/css" href = "hhh.css" />
</head>
<body>
<form action = "<?php echo $_SERVER['PHP_SELF']; ?>"   method = "post">
	<input type = "text" name ="search" placeholder ="search"> 
<select name = "category" >
	<option value = "rollno">ROLLNO</option>
	<option value = "all">ALL</option>

	<option value = "isbn">ISBN</option>
	<option selected value = "keyword">KEYWORDS</option>
</select>
<input type="submit" value="Submit">
</form>
</body>
</html>
<?php
function retrieve($res)
{
	if($res)
	{
		echo "<form method = \"post\" action = \"return.php\">";
		echo "<table border=1 bgcolor=pink>";
		echo "<tr>";
		echo "<td>"."</td>";
		echo "<td>"."FULL_NAME"."</td>";
		echo "<td>"."ROLL_NO"."</td>";
		echo "<td>"."ISBN_NO"."</td>";
		echo "<td>"."BOOK_NAME"."</td>";
		echo "<td>"."ISSUE_DATE"."</td>";
		echo "<td>"."RETURN_DATE"."</td>";
		echo "</tr>";
		while($newarray =mysqli_fetch_array($res, MYSQLI_ASSOC))
		{
			echo "<tr>";
			$fullname = $newarray['FULL_NAME'];
			$rollno = $newarray['ROLL_NO'];
			$isbn_no = $newarray['ISBN_NO'];
			$bookname = $newarray['BOOK_NAME'];
			$issue_date = $newarray['ISSUE_DATE'];
			$return_date = $newarray['RETURN_DATE'];
			echo "<td><input type =\"radio\" name = \"return\" value =\"$isbn_no\"></td>"."<td>".$fullname."</td>"."<td>".$rollno."</td>"."<td>".$isbn_no."</td>"."<td>".$bookname."</td>"."<td>".$issue_date."</td>"."<td>".$return_date."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br/>";
		echo "<input type = \"submit\" value =\"Return\">";
		echo "</form>";
		

	}

}
if(isset($_POST['category']) and isset($_POST['search']))
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
		if($_POST['category'] == "rollno")
		{
			$sql = "SELECT S.FULL_NAME, T1.ROLL_NO,T1.ISBN_NO,T1.BOOK_NAME,T1.ISSUE_DATE,T1.RETURN_DATE FROM (SELECT I.ROLL_NO,I.ISBN_NO,B.BOOK_NAME,I.ISSUE_DATE,I.RETURN_DATE FROM ISSUE_DB I INNER JOIN BOOK_DB B ON I.ISBN_NO = B.ISBN_NO)T1 INNER JOIN STUDENT_REG_TBL S ON T1.ROLL_NO = S.ROLL_NO WHERE T1.ROLL_NO = '".$_POST['search']."'";
			$res = mysqli_query($mysqli,$sql);
			retrieve($res);
			mysqli_free_result($res);
		}
		if($_POST['category'] == "isbn")
		{
			$sql = "SELECT S.FULL_NAME, T1.ROLL_NO,T1.ISBN_NO,T1.BOOK_NAME,T1.ISSUE_DATE,T1.RETURN_DATE FROM (SELECT I.ROLL_NO,I.ISBN_NO,B.BOOK_NAME,I.ISSUE_DATE,I.RETURN_DATE FROM ISSUE_DB I INNER JOIN BOOK_DB B ON I.ISBN_NO = B.ISBN_NO)T1 INNER JOIN STUDENT_REG_TBL S ON T1.ROLL_NO = S.ROLL_NO WHERE T1.ISBN_NO =  '".$_POST['search']."'";
			$res = mysqli_query($mysqli,$sql);
			retrieve($res);
			mysqli_free_result($res);
		}
		if($_POST['category'] == "all")
		{
			$sql = "SELECT S.FULL_NAME, T1.ROLL_NO,T1.ISBN_NO,T1.BOOK_NAME,T1.ISSUE_DATE,T1.RETURN_DATE FROM (SELECT I.ROLL_NO,I.ISBN_NO,B.BOOK_NAME,I.ISSUE_DATE,I.RETURN_DATE FROM ISSUE_DB I INNER JOIN BOOK_DB B ON I.ISBN_NO = B.ISBN_NO)T1 INNER JOIN STUDENT_REG_TBL S ON T1.ROLL_NO = S.ROLL_NO";
			$res = mysqli_query($mysqli,$sql);
			retrieve($res);
			mysqli_free_result($res);
		}
	}
	mysqli_close($mysqli);
}
?>

