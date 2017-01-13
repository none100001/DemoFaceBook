<?php
	include_once("db_conx.php");
	include_once("chat.func.php");

	if(isset($_GET['accepter'])&&!empty($_GET['accepter'])) {
		$accepter = $_GET['accepter'];
		$messages = get_msg($accepter);
		foreach($messages as $message) {
			echo '<strong>'.$message['whom'].' Sent</strong><br />';
			echo $message['message'].'<br /><br />';
		}
	}

?>