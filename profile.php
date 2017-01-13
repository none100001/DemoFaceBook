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
		$sql = "SELECT * FROM block WHERE giver = '$user' AND accepter = '$visitor' ";
		$query = mysqli_query($db_conx, $sql);

		$numrows = mysqli_num_rows($query);
	  	if($numrows >= 1){
	    	echo "Sorry This user Blocked You";
	    	exit();
	    }
	    else{
	    	$sql = "SELECT * FROM block WHERE giver = '$visitor' AND accepter = '$user' ";
			$query = mysqli_query($db_conx, $sql);

			$numrows = mysqli_num_rows($query);
		  	if($numrows >= 1){
		    	echo "Sorry You Blocked This User";
		    	exit();
		    }
	    }
	}
}

?>




<?php

if (isset($_POST["postmsg"]) && isset($_POST["visi"]) && isset($_POST["use"])) {

	include_once("db_conx.php");
	$p = $_POST["postmsg"];
	$v = $_POST["visi"];
	$u = $_POST["use"];

	$sql = "INSERT INTO post VALUES('$v','$p','$u')";
	$query = mysqli_query($db_conx, $sql);

	$sql = "SELECT * FROM post WHERE toname = '$u' ";
	$query = mysqli_query($db_conx, $sql);

	while($row = mysqli_fetch_array($query)){
	    echo $row["fromname"].": ".$row["posts"]."<br>";
	}
	exit();
}



?>




<?php

if (isset($_POST["giver"]) && isset($_POST["accepter"])) {  //addfriend er ta

	include_once("db_conx.php");
	$g = $_POST["giver"];
	$a = $_POST["accepter"];

    $sql = "SELECT * FROM friend WHERE (giver = '$g' AND accepter = '$a') OR (giver = '$a' AND accepter = '$g')"; // g,  a kea request pathaicea....
	$query = mysqli_query($db_conx, $sql);

	$numrows = mysqli_num_rows($query);
	if($numrows<1){

		$sql = "SELECT * FROM request WHERE (giver = '$g' AND accepter = '$a') "; // g,  a kea request pathaicea....
		$query = mysqli_query($db_conx, $sql);

		$numrows = mysqli_num_rows($query);
		if($numrows<1){
			$sql = "INSERT INTO request VALUES('$g', '$a')"; // g,  a kea request pathaicea....
			$query = mysqli_query($db_conx, $sql);

			echo "Request Sent";
			exit();
		}
		else{
			echo "You already sent friend request to this user";
			exit();
		}
	}
	else{
		echo "This User Is Already You Friend";
		exit();
	}
}

?>




<?php

if (isset($_POST["giverUn"]) && isset($_POST["accepterUn"])) { 

	include_once("db_conx.php");
	$g = $_POST["giverUn"];
	$a = $_POST["accepterUn"];

    $sql = "SELECT * FROM friend WHERE (giver = '$g' AND accepter = '$a') OR (giver = '$a' AND accepter = '$g')";
	$query = mysqli_query($db_conx, $sql);

	$numrows = mysqli_num_rows($query);
	if($numrows<1){
		echo "This User Was Not Your Friend So How Can You Unfriend This User";
		exit();
	}
	else{
	    $sql = "DELETE FROM friend WHERE (giver = '$g' AND accepter = '$a') OR (giver = '$a' AND accepter = '$g')";
		$query = mysqli_query($db_conx, $sql);

		echo "UnFriend Successfully Done";
		exit();
	}
}

?>



<?php

if (isset($_POST["giverBc"]) && isset($_POST["accepterBc"])) { 

	include_once("db_conx.php");
	$g = $_POST["giverBc"];
	$a = $_POST["accepterBc"];

    $sql = "INSERT INTO block VALUES ('$g','$a')";
	$query = mysqli_query($db_conx, $sql);



    $sql = "SELECT * FROM friend WHERE (giver = '$g' AND accepter = '$a') OR (giver = '$a' AND accepter = '$g')";
	$query = mysqli_query($db_conx, $sql);

	$numrows = mysqli_num_rows($query);
	if($numrows<1){
	}
	else{
	    $sql = "DELETE FROM friend WHERE (giver = '$g' AND accepter = '$a') OR (giver = '$a' AND accepter = '$g')";
		$query = mysqli_query($db_conx, $sql);
	}

	echo "Block This User Succesfully Done";
	exit();
}

?>










<script src="head.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">



function FL(){
	var u = "<?php echo $user; ?>";
	var v = "<?php echo $visitor; ?>";
	if(u==v){
		window.location = "friendlist.php?e="+u ;
	}
	else{
		alert("Sorry This Is Not Your Profile");
	}
}





function BL(){
	var u = "<?php echo $user; ?>";
	var v = "<?php echo $visitor; ?>";
	if(u==v){
		window.location = "blockedlist.php?e="+u ;
	}
	else{
		alert("Sorry This Is Not Your Profile");
	}
}







function FR(){
	var u = "<?php echo $user; ?>";
	var v = "<?php echo $visitor; ?>";
	if(u==v){
		window.location = "friendrequest.php?e="+u ;
	}
	else{
		alert("Sorry This Is Not Your Profile");
	}
}



function CM(){
	var u = "<?php echo $user; ?>";
	var v = "<?php echo $visitor; ?>";
	if(u==v){
		window.location = "composemsg.php?e="+u ;
	}
	else{
		alert("Sorry This Is Not Your Profile");
	}
}




function I(){
	var u = "<?php echo $user; ?>";
	var v = "<?php echo $visitor; ?>";
	if(u==v){
		window.location = "inbox.php?e="+u ;
	}
	else{
		alert("Sorry This Is Not Your Profile");
	}
}




function GC(){
	var v = "<?php echo $visitor; ?>";
	var u = "<?php echo $user; ?>";
	if(v==u){
		window.location = "groupchat.php?e="+u ;
	}
	else{
		alert("Sorry This Is Not Your Profile");
	}
}











function AC(){
	var v = "<?php echo $visitor; ?>";
	var u = "<?php echo $user; ?>";
	if(v==u){
		window.location = "account_settings.php?e="+u ;
	}
	else{
		alert("Sorry This Is Not Your Profile");
	}
}


function P(){
	var u = "<?php echo $user; ?>";
	window.location = "profile.php?e="+u ;
}

function L(){
	var u = "<?php echo $user; ?>";
	var v = "<?php echo $visitor; ?>";
	if(u==v){
		window.location = "logout.php?e="+u ;
	}
	else{
		alert("Sorry This Is Not Your Profile");
	}
}





function CH(){
	var u = "<?php echo $user; ?>";
	var v = "<?php echo $visitor; ?>";
	if(u==v){
		window.location = "chatroom.php?e="+u ;
	}
	else{
		alert("Sorry This Is Not Your Profile");
	}
}









function go(){
	var t = method("tp").value;
	var v = "<?php echo $visitor; ?>";
	var u = "<?php echo $user; ?>";
	var ajax = ajaxObj("POST", "profile.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        method("tf").innerHTML = ajax.responseText;
      }
    }
    ajax.send("postmsg="+t+"&visi="+v+"&use="+u);
}

function addfriend(){
	var v = "<?php echo $visitor; ?>";
	var u = "<?php echo $user; ?>";
	if(v==u){
		alert("You Cant Give Friend Request To Yourself");
	}
	else{
		var ajax = ajaxObj("POST", "profile.php");
	    ajax.onreadystatechange = function() {
	      if(ajaxReturn(ajax) == true) {
	        alert(ajax.responseText);
	      }
	    }
	    ajax.send("giver="+v+"&accepter="+u); // its just like v, u kea request pathaicea
	}
}






function sendmsg(){
	var u = "<?php echo $user; ?>";
	window.location = "sendmsg.php?e="+u ;
}


function SE(){
	window.location = "seeuser.php" ;
}











function unfriend(){
	var v = "<?php echo $visitor; ?>";
	var u = "<?php echo $user; ?>";
	if(v==u){
		alert("You Cant UnFriend To Yourself");
	}
	else{
		var ajax = ajaxObj("POST", "profile.php");
	    ajax.onreadystatechange = function() {
	      if(ajaxReturn(ajax) == true) {
	        alert(ajax.responseText);
	      }
	    }
	    ajax.send("giverUn="+v+"&accepterUn="+u); // its just like v, u kea unfriend kortece
	}
}


function block(){
	var v = "<?php echo $visitor; ?>";
	var u = "<?php echo $user; ?>";
	if(v==u){
		alert("You Cant Block To Yourself");
	}
	else{
		var ajax = ajaxObj("POST", "profile.php");
	    ajax.onreadystatechange = function() {
	      if(ajaxReturn(ajax) == true) {
	        alert(ajax.responseText);
	        window.location = "profile.php?e="+v ;
	      }
	    }
	    ajax.send("giverBc="+v+"&accepterBc="+u); // its just like v, u kea block kortece
	}
}











</script>





<html>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
<center>
<head>
<?php
	global $user;
	echo "<h1>".$user."<h1>";
?>	
</head>
<body id = "profilebody">
		<div id = "af">
			<button class = "ad" onclick="addfriend()">Add Friend</button>
			<button class = "ad" onclick="sendmsg()">Send Message</button>
			<button class = "ad" onclick="unfriend()">Unfriend</button>
			<button class = "ad" onclick="block()">Block</button>
		</div>
<div id = "buttons">
<button id = "seeuser" onclick="SE()">See The Users</button>
<button id = "accountSetting" onclick="AC()">Accounts Setting</button>
<button id = "profile" onclick="P()" >Profile</button>
<button id = "friendrequest" onclick="FR()" >Friend Request</button>
<button id = "friendl" onclick="FL()" >Friend List</button>
<button id = "blockedlist" onclick="BL()" >Blocked List</button>
<button id = "composemsg" onclick="CM()" >Compose Message</button>
<button id = "inbox" onclick="I()" >Inbox</button>
<button id = "chatroom" onclick="CH()" >Chat House</button>
<button id = "groupchat" onclick="GC()" >Group Chat</button>
<button id = "logout"  onclick="L()" >Logout</button>
</div>
</center>







</body>
</html>