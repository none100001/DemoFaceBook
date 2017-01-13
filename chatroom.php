<?php
include_once("db_conx.php");
session_start();
$visitor = "";
$user = "";
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_password"])) {
   $visitor = $_SESSION["user_email"];

}

if(isset($_GET["e"])){
	include_once("db_conx.php");
	$user = $_GET["e"];

	if($user != $visitor){
		echo "Sorry You Are Not Boss";
		exit();
	}
}




if (isset($_POST["sendingmsg"]) && isset($_POST["jakeadibo"])) {
	$msg = $_POST["sendingmsg"];
	$jakeadibo = $_POST["jakeadibo"];

	$sql = "INSERT INTO message VALUES('$visitor','$msg','$jakeadibo')";
	$query = mysqli_query($db_conx, $sql);

	echo "SEND";
	exit();
}
?>








<script type="text/javascript" src="jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="autolist.js"></script>
<script src="head.js"></script>
<script src="ajax.js"></script>
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




function go(a){
	var i = "I"+a;
	var msgtosend = method(i).value;
	var ajax = ajaxObj("POST", "chatroom.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        alert(ajax.responseText);
      }
    }
    ajax.send("sendingmsg="+msgtosend+"&jakeadibo="+a);

}














	



function f(name){
	var d = name;
	var interval = setInterval(function() {
		$.ajax({
			url: 'ChatRequest.php',
			data: {jakea: name},
			success: function(data) {
				var newdata = data.split(" ");
				var ans = "";
				for(var c = 1;c<newdata.length;c++){
					ans = ans + newdata[c]+"<br>";
				}
				$('#F'+newdata[0]).html(ans);
			}
		});
	}, 1000);
}












</script>









<html>
<head>
</head>
<body>




<div id = "chatlist" style="float:right"></div>



<center>
<div class="msg_box">
<?php
global $db_conx;

$sql = "SELECT * FROM user";
$query = mysqli_query($db_conx, $sql);

echo "<div class = 'msg_body' >";
while($row = mysqli_fetch_array($query)){
	echo "<div id = box".$row["username"].">";
		echo "<div id= H".$row["username"].">".$row["username"]."</div>";
		echo "<div id= B".$row["username"].">";
			echo "<div id = F".$row["username"]."></div>";
			$a = $row["username"];
			echo "<div class = 'msg_input' rows = '14' >";
				echo "<input type = 'text' id = I".$row["username"]." onchange = \"go('$a')\" />";
			echo "</div>";
		echo "</div>";
	echo "</div>";
}
echo "</div>";
?>
</div>
</center>






<div id="onlineoffline" style="float:right">
	<button id = "a" onclick="online()">ONLINE</button>
	<button id = "b" onclick="offline()">OFFLINE</button>
</div>


</body>
</html>










