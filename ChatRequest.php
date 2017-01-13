<?php
	include_once("db_conx.php");
	include_once("chatrequest.func.php");
	$jakea = "";

	if(isset($_GET['jakea'])&&!empty($_GET['jakea'])) {
		$jakea = $_GET['jakea'];
	}


	$messages = get_totalmsg($jakea);
	$first = true;

	foreach($messages as $message) {
		if($first){
			echo $message['whom']." ".$message["message"]."<br>";
			$first = false;
		}
		else{
			echo $message["message"]."<br>";
		}
	}
	echo "<br><br><br><br>";

?>