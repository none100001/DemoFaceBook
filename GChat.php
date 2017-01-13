<?php
	include_once("db_conx.php");
	include_once("G.chat.func.php");

	$infos = get_info();
	$five = 5;
	foreach($infos as $info) {
		echo '<strong>'.$info['email'].'</strong>';
		if($info['value'] == $five){
			echo '<strong>'.'<img src = userdata/pictures/offline.png />'.'</strong>'."<br>";
		}
		else{
			echo '<strong>'.'<img src = userdata/pictures/online.png />'.'</strong>'."<br>";
		}
	}

?>