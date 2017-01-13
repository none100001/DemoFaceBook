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
?>


<?php
if (isset($_POST["preemail"]) && isset($_POST["newemail"])) {
	include_once("db_conx.php");

	$pe = $_POST["preemail"];
	$ne = $_POST["newemail"];


	$sql = " UPDATE user SET email ='$ne' WHERE email ='$pe' ";
	$query = mysqli_query($db_conx, $sql);

	echo "updated email succesfully by new email ".$ne;
	exit(); 
}

?>  








<script src="head.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">

function Done(){
	var pe = "<?php echo $visitor; ?>";
	var ne1 = method("ne1").value;
	var ne2 = method("ne2").value;
	if(ne1!=ne2){
		method("status").innerHTML  = "Two new email are not same";
	}
	else{
		var ajax = ajaxObj("POST", "change_email.php");
	  	ajax.onreadystatechange = function() {
		    if(ajaxReturn(ajax) == true) {
		        method("status").innerHTML = ajax.responseText;
		    }
		}
  		ajax.send("preemail="+pe+"&newemail="+ne1);
	}
}
</script>











<html>
<body>

<center>
<div id = "changename">
    <form name="changenameform" id="changenameform" onsubmit="return false">
		<h2>New Email</h2>
		<input type="text" size="40" name="ne1" id="ne1" /></br>
		<h2>Again New Email</h2>
		<input type="text" size="40" name="ne2" id="ne2" /></br>
		<button id="button" onclick="Done()">Done </button></br>
	</form>
	<span id = "status"></span>
</div>
</center>



<body>
<html>
