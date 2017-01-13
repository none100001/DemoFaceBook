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

	function get_msg() {

		global $db_conx;
		global $visitor;
		
		//$query = "SELECT * FROM message WHERE (giver = '$visitor' AND accepter = '$accepter') OR (giver = '$accepter' AND accepter = '$visitor') ";
		
		$query = "SELECT * FROM message WHERE (giver = '$visitor' OR accepter = '$visitor') ";


		$run = mysqli_query($db_conx,$query);
		
		$messages = array();
		
		while($message = mysqli_fetch_array($run)) {
			 $messages[] = array('whom'=>$message['giver'], 'message'=>$message['msg']);
		}
		
		return $messages;
		
	}
	
	function send_msg($accepter, $message) {

		global $db_conx;
		global $visitor;
		
		if(!empty($accepter) && !empty($message)) {
			
			
			$sql = "INSERT INTO message VALUES('$visitor','$message','$accepter')";
			mysqli_query($db_conx, $sql);

			return true;
			
		} else {
			return false;
		}
	}

?>
