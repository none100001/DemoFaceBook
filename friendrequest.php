<?php
include_once("db_conx.php");
session_start();
$visitor = "";
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_password"])) {
   $visitor = $_SESSION["user_email"];
}









if (isset($_POST["giver"])) {
  $accepter = $visitor;
  $giver = $_POST["giver"];

  $sql = "INSERT INTO friend VALUES ('$giver','$accepter') ";
  $query = mysqli_query($db_conx, $sql);


  $sql = "DELETE FROM request WHERE giver='$giver' AND accepter = '$accepter' ";
  mysqli_query($db_conx, $sql);


  echo "You Are Now Friends With ".$giver;
  exit();
  
}



if (isset($_POST["Ngiver"])) {
  $accepter = $visitor;
  $giver = $_POST["Ngiver"];

  $msg = "Sorry ".$accepter." rejected you request So Your request will be deleted too";

  $sql = "INSERT INTO message VALUES ('$accepter','$msg','$giver') ";
  $query = mysqli_query($db_conx, $sql);

  $sql = "DELETE FROM request WHERE giver='$giver' AND accepter = '$accepter' ";
  mysqli_query($db_conx, $sql);

  $sql = "DELETE FROM friend WHERE giver='$giver' AND accepter = '$accepter' ";
  mysqli_query($db_conx, $sql);

  echo "You Rejected ".$giver;
  exit();
  
}






if (isset($_POST["head"])) {
  $v = $_POST["head"];

  $sql = "SELECT * FROM request WHERE accepter = '$v' ";
  $query = mysqli_query($db_conx, $sql);

  $numrows = mysqli_num_rows($query);
  if($numrows>=1){
	  echo '<table style ="width:300px">';
	  echo '<tr>';
	  echo '<td>GIVER</td>';
	  echo '</tr>';
	  echo '<tr>';
	  $counter = 0; 
	  while($row = mysqli_fetch_array($query)){
	  	  $giver = $row["giver"];
	  	  $a = $giver."a";
	  	  $d = $giver."d";
	      echo '<td>'. $giver .'</td>'; 
	      echo '<td>'. "<button id = '$a' onclick=\"acc('$a','$d','$giver')\">Accept</button>".'</td>'; 
	      echo '<td>'. "<button id = '$d' onclick=\"dec('$d','$a','$giver')\">Decline</button>".'</td>'; 
	      echo '</tr>';
	      echo '<tr>';
	  }
	  echo '<tr>';
	  echo '</table>';
	  exit();
   }
   else{
   	 echo "Sorry You Have No Friend Request";
   	 exit();
   }
}
?>




<script src="head.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">



function acc(a,d,g){


	document.getElementById(a).disabled = true;
	document.getElementById(d).disabled = false;





	var ajax = ajaxObj("POST", "friendrequest.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        alert(ajax.responseText);
      }
    }
    ajax.send("giver="+g);


}




function dec(d,a,g){

	document.getElementById(d).disabled = true;
	document.getElementById(a).disabled = false;



	var ajax = ajaxObj("POST", "friendrequest.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        alert(ajax.responseText);
      }
    }
    ajax.send("Ngiver="+g);

}


// ekta msg dibea $g kea jea accept korsea $a;


function go(){
	var visitor = "<?php echo $visitor; ?>";
	var ajax = ajaxObj("POST", "friendrequest.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        method("total").innerHTML = ajax.responseText;
      }
    }
    ajax.send("head="+visitor);
}

</script>






<html>
<body onload= "go()" id = "total">
<body>
<html>





