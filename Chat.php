<?php
	include_once("db_conx.php");
	include_once("chat.func.php");

		$messages = get_msg();
		foreach($messages as $message) {
			echo '<strong>'.$message['whom'].'</strong><br />';
			echo $message['message'].'<br /><br />';
		}

?>