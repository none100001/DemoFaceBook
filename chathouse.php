<?php
$user = "";
if(isset($_GET["e"])){
	include_once("db_conx.php");
	$user = $_GET["e"];
}


if (isset($_POST["message"]) && isset($_POST["giver"])) {

	$d = $_POST["giver"];

	$sql = "INSERT INTO message VALUES('$user','$msg','$d') ";
	$query = mysqli_query($db_conx, $sql);

	echo "Nothing";
	exit();	
}
?>




<script src="head.js"></script>
<script src="ajax.js"></script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>



<script type="text/javascript">
$(document).ready(function(){
<?php	
	
	include_once("db_conx.php");
	global $db_conx;

	$sql = "SELECT * FROM friend WHERE accepter = '$user' OR giver = '$user' ";
	$query = mysqli_query($db_conx, $sql);

	while($row = mysqli_fetch_array($query)){
		if($row["giver"]!=$user){

			echo "$(#".$row["giver"].").on('input', function() {";

			echo "var msg = $(this).val();";
			echo "var p ="."<?php".$row['giver']."?>);";

				echo "var ajax = ajaxObj('POST', 'chathouse.php');";
				echo "ajax.onreadystatechange = function() {";
					echo "if(ajaxReturn(ajax) == true) {";
						     echo "ajax.responseText;";
					echo "}";
				echo "}";
			    
			    echo "ajax.send('message='+msg+'&giver='+p)";

			echo "});";

		}
		else{

			echo "$(#".$row["accepter"].").on('input', function() {";

			echo "var msg = $(this).val();";
			echo "var p ="."<?php".$row['accepter']."?>);";

				echo "var ajax = ajaxObj('POST', 'chathouse.php');";
				echo "ajax.onreadystatechange = function() {";
					echo "if(ajaxReturn(ajax) == true) {";
						     echo "ajax.responseText;";
					echo "}";
				echo "}";
			    
			    echo "ajax.send('message='+msg+'&giver='+p";

			echo "});";
		}
	}
?>
});
</script>






<script type="text/javascript">

function sendmsg(){
	var a = method("accepter").value;
	var m = method("msg").value;
	var g = "<?php $user; ?>";

	var ajax = ajaxObj("POST", "chathouse.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        ajax.responseText;
      }
    }
    ajax.send("giver="+g+"&msg="+m+"&accepter="+a);
}

</script>







<html>
<head></head>
<body>


<div class = "chatarea">
<?php

    echo "<div class='chathead'>Friends</div>";
	include_once("db_conx.php");
	global $user;
	global $db_conx;

	$sql = "SELECT * FROM friend WHERE accepter = '$user' ";
	$query = mysqli_query($db_conx, $sql);

	echo "<div class='chatbody'>";
	while($row = mysqli_fetch_array($query)){
	    echo "<div class=".$row["giver"].">".$row["giver"]."</div>";
	}
	echo "</div>";
?>
</div>




<div class = "msgarea">
<?php

	include_once("db_conx.php");
	global $user;
	global $db_conx;

	$sql = "SELECT * FROM friend WHERE accepter = '$user' OR giver = '$user' ";
	$query = mysqli_query($db_conx, $sql);

	while($row = mysqli_fetch_array($query)){
		if($row["giver"]!=$user){
			echo "<div class=".$row["giver"].">".$row["giver"];

				$sql2 = "SELECT * FROM message WHERE accepter = '$user' OR giver = '$user' ";
				$query2 = mysqli_query($db_conx, $sql2);
				while($row2 = mysqli_fetch_array($query2)){
					if($row2["giver"]!=$user){
						echo $row2["giver"];
						echo $row2["msg"];
					}
					else{
						echo $row2["accepter"];
						echo $row2["msg"];
					}
				}

				echo "<input type = 'text' size = '10' id=".$row["giver"]."></input>";				
			echo "</div>";
		}
		else{
			echo "<div class=".$row["accepter"].">".$row["accepter"];

				$sql3 = "SELECT * FROM message WHERE accepter = '$user' OR giver = '$user' ";
				$query3 = mysqli_query($db_conx, $sql3);
				while($row4 = mysqli_fetch_array($query3)){
					if($row4["giver"]!=$user){
						echo $row4["giver"];
						echo $row4["msg"];
					}
					else{
						echo $row4["accepter"];
						echo $row4["msg"];
					}
				}
				echo "<input type = 'text' size = '10' id=".$row["accepter"]."></input>";				
			echo "</div>";
		}	
	}
?>

</div>

</body>
</html>










