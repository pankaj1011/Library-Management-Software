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
$q = $_GET['q'];
$c = $_GET['c'];
//echo "<br />";
//echo "q = ".$q;
//echo "<br />";
//echo "c = ".$c;
//echo "<br />";
		include '../info.php';
$mysqli  = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
if(mysqli_connect_errno())
{
	printf("connection failed: %s\n",mysqli_connect_error());
	exit();
}
else
{
	if($c == "title")
	{
		$sql = "SELECT * FROM BOOK_DB WHERE BOOK_NAME LIKE '%".$q."%'";
		$res = mysqli_query($mysqli,$sql);
		//echo "noofrows = ".mysqli_num_rows($res);
		//	echo "<br />";
		retrieve($res);
	}
	if($c == "author")
	{
		$sql = "SELECT * FROM BOOK_DB WHERE AUTHOR LIKE '%".$q."%'";
		$res = mysqli_query($mysqli,$sql);
		//echo "noofrows = ".mysqli_num_rows($res);
		//	echo "<br />";
		retrieve($res);
	}

	mysqli_close($mysqli);

}

?>

