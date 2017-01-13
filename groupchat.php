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



?>







<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript">

function online(){
	document.getElementById("a").disabled = true;
	document.getElementById("b").disabled = false;
	
	$.ajax({
		url: 'GSend.php',
		data: {line: 1}, 
	});
	
}







function offline(){
	document.getElementById("b").disabled = true;
	document.getElementById("a").disabled = false;
	
	$.ajax({
		url: 'GSend.php',
		data: {line: 5}, 

	});
	
}







</script>





















<!DOCTYPE html>
<html>
	<head>
	<link rel = "stylesheet" type = "text/css" href = "style.css" />
		<title>Chat Application</title>
		
	</head>
	<body id = "groupbody">
	<center>
		<div id="input">
			<div id="feedback"></div>
			<form action="#" method="post" id="form_input">
				<lable>Enter Name:<input type="text" name="accepter" id="accepter"/></lable>
				<br /><lable>Enter Message:<br /><textarea id="message" cols="25" rows="4"></textarea></lable><br />
				<input type="submit" name="send" id="send" value="Send Message"/>
			</form>
		</div>
	</center>
		
		<center>
		<div id="messages">
		</center>

		<div id="friendlist"></div>


		<div id="line_input">
			<button id = "a" onclick="online()">ONLINE</button>
			<button id = "b" onclick="offline()">OFFLINE</button>
		</div>
		
		<script type="text/javascript" src="Gauto_chat.js"></script>
		<script type="text/javascript" src="auto_chat.js"></script>
		<script type="text/javascript" src="send.js"></script>

		
	</body>
</html>