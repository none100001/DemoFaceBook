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
if (isset($_POST["prename"]) && isset($_POST["newname"]) && isset($_POST["email"])) {
	include_once("db_conx.php");

	$pn = $_POST["prename"];
	$nn = $_POST["newname"];
	$email = $_POST["email"];


  	$sql = "SELECT * FROM user WHERE username = '$pn' AND email = '$email' ";
  	$query = mysqli_query($db_conx, $sql);

  	$numrows = mysqli_num_rows($query);
	if($numrows<1){
	    echo "Sorry previous name is wrong according to this email";
	    exit();
	}
	else{
		$sql = " UPDATE user SET username='$nn' WHERE email ='$email' ";
		$query = mysqli_query($db_conx, $sql);

		echo "updated username succesfully by new name ".$nn;
		exit(); 
	}
}

?>  








<script src="head.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">

function Done(){
	var pn = method("pn").value;
	var nn1 = method("nn1").value;
	var nn2 = method("nn2").value;
	var email = "<?php echo $visitor; ?>";
	if(nn1!=nn2){
		method("status").innerHTML  = "Two new name are not correct";
	}
	else{
		var ajax = ajaxObj("POST", "change_name.php");
	  	ajax.onreadystatechange = function() {
		    if(ajaxReturn(ajax) == true) {
		        method("status").innerHTML = ajax.responseText;
		    }
		}
  		ajax.send("prename="+pn+"&newname="+nn1+"&email="+email);
	}
}
</script>











<html>
<body>

<center>
<div id = "changename">
    <form name="changenameform" id="changenameform" onsubmit="return false">
        <h2>Previous Name</h2>
		<input type="text" size="40" name="pn" id="pn" /></br>
		<h2>New Name</h2>
		<input type="text" size="40" name="nn1" id="nn1" /></br>
		<h2>Again New Name</h2>
		<input type="text" size="40" name="nn2" id="nn2" /></br>
		<button id="button" onclick="Done()">Done </button></br>
	</form>
	<span id = "status"></span>
</div>
</center>



<body>
<html>
