<html>
<body>
<form action = "<?php echo $_SERVER['PHP_SELF']; ?>"   method = "post">
	<input type = "text" name ="search" placeholder ="search"> 
<select name = "category" >
	<option value = "title">TITLE</option>
	<option value = "author">AUTHOR</option>
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
		echo "<table border=1 bgcolor=pink>";
		echo "<tr>";
		echo "<td>"."BOOK_NAME"."</td>";
		echo "<td>"."AUTHOR"."</td>";
		echo "<td>"."ISBN_NO"."</td>";
		echo "<td>"."NO_OF_CPY"."</td>";
		echo "</tr>";
		while($newarray =mysqli_fetch_array($res, MYSQLI_ASSOC))
		{
			echo "<tr>";
			$title = $newarray['BOOK_NAME'];
			$author = $newarray['AUTHOR'];
			$isbnno = $newarray['ISBN_NO'];
			$noofcpy = $newarray['NO_OF_CPY'];
			echo "<td>".$title."</td>"."<td>".$author."</td>"."<td>".$isbnno."</td>"."<td>".$noofcpy."</td>";
			echo "</tr>";
		}
		echo "</table>";

	}

}
if(isset($_POST['category']) and isset($_POST['search']))
{
		include '../info.php';
$mysqli  = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
	if(mysqli_connect_errno())
	{
		printf("connection failed: %s\n",mysqli_connect_error());
		exit();
	}
	else
	{
		if($_POST['category'] == "title")
		{
			$sql = "SELECT * FROM BOOK_DB WHERE BOOK_NAME LIKE '%".$_POST['search']."%'";
			$res = mysqli_query($mysqli,$sql);
			retrieve($res);
			mysqli_free_result($res);
		}
		if($_POST['category'] == "author")
		{
			$sql = "SELECT * FROM BOOK_DB WHERE AUTHOR = '".$_POST['search']."'";
			$res = mysqli_query($mysqli,$sql);
			retrieve($res);
			mysqli_free_result($res);
		}
		if($_POST['category'] == "isbn")
		{
			$sql = "SELECT * FROM BOOK_DB WHERE ISBN_NO = '".$_POST['search']."'";
			$res = mysqli_query($mysqli,$sql);
			retrieve($res);
			mysqli_free_result($res);
		}
	}
	mysqli_close($mysqli);
}
?>

