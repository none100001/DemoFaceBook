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
	if($user!=$visitor){
		echo "Sorry You Are Not The Boss";
		exit();
	}
}

?>


<?php
if (isset($_POST["message"]) && isset($_POST["visitor"]) && isset($_POST["to"])) {
   include_once("db_conx.php");

   $m = $_POST["message"];
   $v = $_POST["visitor"];
   $to = $_POST["to"];

   $sql = "SELECT * FROM user WHERE email = '$to' ";
   $query = mysqli_query($db_conx, $sql);

   $numrows = mysqli_num_rows($query);
   if($numrows<1){
   		echo "Sorry User Does Not Exist";
		exit();
	}
	else{
	   $sql = "INSERT INTO message VALUES('$v','$m','$to')";
	   $query = mysqli_query($db_conx, $sql);
	   echo "Message Composed Successfully";
	   exit();
	}
}
?>









<script src="head.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">

function Send(){ // visitor user kea smg pathabea..
	var message = method("message").value;
	var to = method("to").value;

	var visitor = "<?php echo $visitor; ?>";

	var ajax = ajaxObj("POST", "composemsg.php");
	ajax.onreadystatechange = function() {
		if(ajaxReturn(ajax) == true) {
		     alert(ajax.responseText);
		}
	}
    ajax.send("message="+message+"&visitor="+visitor+"&to="+to);
}



</script>














<html>
<body>



<center>
<div class = "msgform">
	<form name="msform" id="msform" onsubmit="return false">
		<input type="text" size="40" name="to" id="to" placeholder = "To....." /></br>
		<textarea name="message" id="message" rows="3" cols="38" class = "auto-clear" placeholder = "Write Message Here....." style="width: 335px; height: 90px;"></textarea></br>
		<button id="button" onclick="Send()">Send</button>
	</form>
</div>
</center>




</html>
</body>