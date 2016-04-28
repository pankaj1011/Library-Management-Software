<?php
session_start();
if($_SESSION['user'] == NULL)
{
	header("Location:login.php");
}
		include 'info.php';
		$mysqli = mysqli_connect($host,$dblogin,$dbpassword,$dbname);
if(mysqli_connect_errno())
{
	pritnf("connection failed:%s\n",mysqli_connect_error());
	exit();
}
$d = date_create(NULL);
$cd = date_format($d,"Y-m-d");
$sql = "SELECT S.FULL_NAME, T1.ROLL_NO,T1.ISBN_NO,T1.BOOK_NAME,T1.ISSUE_DATE,T1.RETURN_DATE FROM (SELECT I.ROLL_NO,I.ISBN_NO,B.BOOK_NAME,I.ISSUE_DATE,I.RETURN_DATE FROM ISSUE_DB I INNER JOIN BOOK_DB B ON I.ISBN_NO = B.ISBN_NO)T1 INNER JOIN STUDENT_REG_TBL S ON T1.ROLL_NO = S.ROLL_NO WHERE T1.RETURN_DATE < '$cd'";
$res = mysqli_query($mysqli,$sql);
if($res)
{

	echo "<table border=1 bgcolor=pink>";
	echo "<tr>";
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
         echo "<td>".$fullname."</td>"."<td>".$rollno."</td>"."<td>".$isbn_no."</td>"."<td>".$bookname."</td>"."<td>".$issue_date."</td>"."<td>".$return_date."</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br/>";

}
?>
<html>
<head>
<link rel = "STYLESHEET" type ="text/css" href = "hhh.css" />
</head>
</html>

