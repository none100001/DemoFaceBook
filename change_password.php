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
if (isset($_POST["prepassword"]) && isset($_POST["newpassword"]) && isset($_POST["email"])) {
	include_once("db_conx.php");

	$pp = $_POST["prepassword"];
	$np = $_POST["newpassword"];
	$email = $_POST["email"];


  	$sql = "SELECT * FROM user WHERE password = '$pp' AND email = '$email' ";
  	$query = mysqli_query($db_conx, $sql);

  	$numrows = mysqli_num_rows($query);
	if($numrows<1){
	    echo "Sorry previous Password is wrong according to this email";
	    exit();
	}
	else{
		$sql = " UPDATE user SET password='$np' WHERE email ='$email' ";
		$query = mysqli_query($db_conx, $sql);

		echo "updated Password succesfully by new Password ".$np;
		exit(); 
	}
}

?>  








<script src="head.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">

function Done(){
	var pp = method("pp").value;
	var np1 = method("np1").value;
	var np2 = method("np2").value;
	var email = "<?php echo $visitor; ?>";
	if(np1!=np2){
		method("status").innerHTML  = "Two new password are not same";
	}
	else{
		var ajax = ajaxObj("POST", "change_password.php");
	  	ajax.onreadystatechange = function() {
		    if(ajaxReturn(ajax) == true) {
		        method("status").innerHTML = ajax.responseText;
		    }
		}
  		ajax.send("prepassword="+pp+"&newpassword="+np1+"&email="+email);
	}
}
</script>











<html>
<body>

<center>
<div id = "changename">
    <form name="changenameform" id="changenameform" onsubmit="return false">
        <h2>Previous Password</h2>
		<input type="text" size="40" name="pp" id="pp" /></br>
		<h2>New Password</h2>
		<input type="text" size="40" name="np1" id="np1" /></br>
		<h2>Again New Password</h2>
		<input type="text" size="40" name="np2" id="np2" /></br>
		<button id="button" onclick="Done()">Done </button></br>
	</form>
	<span id = "status"></span>
</div>
</center>



<body>
<html>
