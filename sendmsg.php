<?php
include_once("db_conx.php");
session_start();
$visitor = "";
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_password"])) {
   $visitor = $_SESSION["user_email"];

}
?>

<?php
$user = "";
if(isset($_GET["e"])){
	include_once("db_conx.php");
	$user = $_GET["e"];
}
?>





<?php
if (isset($_POST["message"]) && isset($_POST["visitor"]) && isset($_POST["user"])) {
   include_once("db_conx.php");

   $m = $_POST["message"];
   $v = $_POST["visitor"];
   $u = $_POST["user"];

   $sql = "INSERT INTO message VALUES('$v','$m','$u')";
   $query = mysqli_query($db_conx, $sql);

   echo "Message Sent Successfully";
   exit();
}
?>









<script src="head.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">

function Send(){ // visitor user kea smg pathabea..
	var message = method("message").value;

	var visitor = "<?php echo $visitor; ?>";
	var user = "<?php echo $user; ?>";

	if(visitor==user){
		alert("ok! You Are Sending Message to Yourself");
	}

	var ajax = ajaxObj("POST", "sendmsg.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
		     alert(ajax.responseText);
		}
	}
    ajax.send("message="+message+"&visitor="+visitor+"&user="+user);
}



</script>














<html>
<body>



<center>
<div class = "msgform">
	<form name="msform" id="msform" onsubmit="return false">
		<textarea name="message" id="message" rows="3" cols="38" class = "auto-clear" placeholder = "Write Message Here....." style="width: 335px; height: 90px;"></textarea></br>
		<button id="button" onclick="Send()">Send</button>
	</form>
</div>
</center>




</html>
</body>