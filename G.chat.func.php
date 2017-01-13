<?php
include_once("db_conx.php");
session_start();
$visitor = "";
$user = "";
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_password"])) {
   $visitor = $_SESSION["user_email"];

}

if(isset($_GET["e"])){
include_once('db_conx.php');

	$user = $_GET["e"];
	if($user!=$visitor){
		echo "Sorry You Are Not The Boss";
		exit();
	}
}

function get_info() {

	global $db_conx;
	global $visitor;
		

		
	$query = "SELECT * from user";

	$run = mysqli_query($db_conx,$query);
		
	$messages = array();
		
	while($message = mysqli_fetch_array($run)) {
		$messages[] = array('email'=>$message['email'], 'value'=>$message['status']);
	}
		
	return $messages;
		
}

?>
