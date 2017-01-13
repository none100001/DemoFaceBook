<?php
	include_once("db_conx.php");
	include_once("chatRequest.func.php");
	
	if(isset($_GET['jakea'])&&!empty($_GET['jakea'])) {
		$jakea = $_GET['jakea'];
		
		if(isset($_GET['ami'])&&!empty($_GET['ami'])) {
			$ami = $_GET['ami'];
			send_msg($jakea, $ami));		
		}
		
	}
	
?>