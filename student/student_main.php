<?php
session_start();
if($_SESSION['user1'] == NULL)
{
	    header("Location:student_login.php");
}

?>



<html>
<frameset cols ="150,*">
    <frame src ="left1.html" name ="left1"/>
    <frame src ="right1.html" name ="right1"/>
</frameset>
</html>

