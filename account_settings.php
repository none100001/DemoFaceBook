<?php
include_once("db_conx.php");
session_start();
$visitor = "";
$user = "";
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_password"])) {
   $visitor = $_SESSION["user_email"];

}

if(isset($_GET["e"])){
	include_once("db_conx.php");
	$user = $_GET["e"];

	if($user != $visitor){
		echo "Sorry You Are Not Boss";
		exit();
	}
}


?>





<html>
<body>

<center>
<table style="width:300px">
<tr>
  <td>Change Name</td>
  <td>Change Email</td>		
  <td>Change Password</td>
  </tr>
<tr>
  <td><a href="change_name.php">SELECT</a></td>
  <td><a href="change_email.php">SELECT</a></td>		
  <td><a href="change_password.php">SELECT</a></td>
</tr>
</table>
<center>

</body>
</html>