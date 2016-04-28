<?php
session_start();
if($_SESSION['user1'] == NULL)
{
	header("Location:student_login.php");
}
		include '../info.php';
$mysqli  = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
if(mysqli_connect_errno())
{
	pritnf("connection failed:%s\n",mysqli_connect_error());
	exit();
}
$sql = "SELECT * FROM  ISSUE_DB WHERE ROLL_NO = '".$_SESSION['user1']."'";
$res = mysqli_query($mysqli,$sql);
if($res)
{
	$noofrows = mysqli_num_rows($res);
	if($noofrows == 0)
	{   

		echo "<script> alert(\"data not fount\") </script>";
		exit();
	}
	else
	{
		echo "<table border=1 bgcolor=pink>";
		echo "<tr>";
		echo "<td>"."ROLL_NO"."</td>";
		echo "<td>"."ISBN_NO"."</td>";
		echo "<td>"."ISSUE_DATE"."</td>";
		echo "<td>"."RETURN_DATE"."</td>";
		echo "</tr>";
		while($newarray =mysqli_fetch_array($res, MYSQLI_ASSOC))
		{
			echo "<tr>";
			$rollno = $newarray['ROLL_NO'];
			$isbn_no = $newarray['ISBN_NO'];
			$issue_date = $newarray['ISSUE_DATE'];
			$return_date = $newarray['RETURN_DATE'];
			echo "<td>".$rollno."</td>"."<td>".$isbn_no."</td>"."</td>"."<td>".$issue_date."</td>"."<td>".$return_date."</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<br/>";

	}
	mysqli_free_result($res);
	mysqli_close($mysqli);

}
?>
