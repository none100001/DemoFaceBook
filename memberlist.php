<?php
	include_once("db_conx.php");
	include_once("list_func.php");

		$messages = get_info();
		foreach($messages as $message) {
			$d = $message['person'];
			echo '<strong>'."<button id = '$d' onclick=\"f('$d')\">".$d."</button>".'</strong>';
			$s = $message['status'];
			if($s==1){
				echo '<img src = userdata/pictures/online.png />'.'<br>';
			}
			else{
				echo '<img src = userdata/pictures/offline.png />'.'<br>';
			}

		}

?>