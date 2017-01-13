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


function get_totalmsg($jakea){

	global $db_conx;
	global $visitor;
	$ami = $visitor;


		
	$query = "SELECT * FROM message WHERE ((giver = '$ami' AND accepter = '$jakea') OR (giver = '$jakea' AND accepter = '$ami')) ";

	$run = mysqli_query($db_conx,$query);
		
	$messages = array();
		
	while($message = mysqli_fetch_array($run)) {
		$ans = "";
		if($message['giver']==$ami){
			$ans = $message["accepter"];
		}
		else{
			$ans = $message["giver"];
		}
		$messages[] = array('whom'=>$ans , 'message'=>$message['msg']);
	}
		
	return $messages;
		
}

?>
