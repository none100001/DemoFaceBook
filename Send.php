<?php
	include_once("db_conx.php");
	include_once("chat.func.php");
	
	if(isset($_GET['accepter'])&&!empty($_GET['accepter'])) {
		$accepter = $_GET['accepter'];
		
		if(isset($_GET['message'])&&!empty($_GET['message'])) {
			$message = $_GET['message'];
			
			if(send_msg($accepter, $message)) {
				echo 'Message Sent';
			} else {
				echo 'Message wasn\'t sent';
			}
			
		} else {
			echo 'No Message was entered';
		}
		
	} else {
		echo 'No Name was entered.';
	}
	
?>