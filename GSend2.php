<?php
	session_start();
	include_once("db_conx.php");
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




	if(isset($_GET['offline'])&&!empty($_GET['offline'])) {
		include_once("db_conx.php");
		echo "sdfsdf";

		$value = $_GET['offline'];


		$sql = " UPDATE user SET status = '$value' WHERE email = '$visitor' ";
		
		$query = mysqli_query($db_conx, $sql);

		echo "Data successfull inserted";
	}
?>