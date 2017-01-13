<?php
include_once("db_conx.php");
session_start();
$visitor = "";
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_password"])) {
   $visitor = $_SESSION["user_email"];
}









if (isset($_POST["jakea"])) {
  $accepter = $visitor;
  $jakea = $_POST["jakea"];



  $sql = "DELETE FROM block WHERE (giver='$accepter' AND accepter = '$jakea') ";
  mysqli_query($db_conx, $sql);


  echo "You UnBlocked ".$jakea;
  exit();
  
}






if (isset($_POST["head"])) {
  $v = $_POST["head"];

  $sql = "SELECT * FROM block WHERE giver = '$v' ";
  $query = mysqli_query($db_conx, $sql);

  $numrows = mysqli_num_rows($query);
  if($numrows>=1){
	  echo '<table style ="width:300px">';
	  echo '<tr>';
	  echo '<td>BlockedList</td>';
	  echo '</tr>';
	  echo '<tr>';
	  $counter = 0; 
	  while($row = mysqli_fetch_array($query)){
        $accepter = $row["accepter"];
	  	  $a = $accepter."a";
	      echo '<td>'. $accepter .'</td>'; 
	      echo '<td>'. "<button id = '$a' onclick=\"acc('$a','$accepter')\">Unblock</button>".'</td>'; 
	      echo '</tr>';
	      echo '<tr>';
	  }
	  echo '<tr>';
	  echo '</table>';
	  exit();
   }
   else{
   	 echo "Sorry You Have No Blocked Request";
   	 exit();
   }
}
?>




<script src="head.js"></script>
<script src="ajax.js"></script>

<script type="text/javascript">



function acc(a,j){


	document.getElementById(a).disabled = true;



	var ajax = ajaxObj("POST", "blockedlist.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        alert(ajax.responseText);
      }
    }
    ajax.send("jakea="+j); //jakea unfriend korbo...


}




// ekta msg dibea $g kea jea accept korsea $a;


function go(){
	var visitor = "<?php echo $visitor; ?>";
	var ajax = ajaxObj("POST", "blockedlist.php");
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





