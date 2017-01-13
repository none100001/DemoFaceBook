<?php
include_once("db_conx.php");
session_start();
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_password"])) {
   header("location: profile.php?e=".$_SESSION["user_email"]);
   exit();
}
?>




<?php

if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])){  
  include_once("db_conx.php");
  $username = $_POST["username"];
  $email    = $_POST["email"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM user WHERE email='$email' ";
  $query = mysqli_query($db_conx, $sql);
  $numrows = mysqli_num_rows($query);
  if($numrows >= 1){
    echo "sorry this email id exist";
    exit();
  }
  else{
    $zero = 1;
    $sql = "INSERT INTO user VALUES ('$username','$password','$email','$zero') ";
    $query = mysqli_query($db_conx, $sql);
    echo "Register succesful";
    exit();
  }


}

?>





<?php

if (isset($_POST["user_email"]) && isset($_POST["user_password"])) {
  include_once("db_conx.php");

  $useremail = $_POST["user_email"];
  $userpassword = $_POST["user_password"];

  $sql = "SELECT * FROM user WHERE email = '$useremail' AND password = '$userpassword' ";
  $query = mysqli_query($db_conx, $sql);

  $numrows = mysqli_num_rows($query);
  if($numrows<1){
    echo "Sorry username or password does not match";
    exit();
  }
  else{
    $_SESSION["user_email"] = $useremail;
    $_SESSION["user_password"] = $userpassword;

    header("location: profile.php?e=".$_SESSION["user_email"]);
    exit();
  }


}
?>















<script src="head.js"></script>
<script src="ajax.js"></script>



<script type="text/javascript">

function register(){
  var un = method("username").value;
  var ea = method("email").value;
  var pa1 = method("pass1").value;
  var pa2 = method("pass2").value;
  if(un =="" || ea == "" || pa1 == "" || pa2 ==""){
     method("status").innerHTML =  "Please fill all the forms";
  }
  else{
    var ajax = ajaxObj("POST", "header.php");
    ajax.onreadystatechange = function() {
      if(ajaxReturn(ajax) == true) {
        header("location: profile.php?e="+ajax.responseText);
      }
    }
    ajax.send("username="+un+"&email="+ea+"&password="+pa1);
  }
}






</script>







<html>
<link rel = "stylesheet" type = "text/css" href = "style.css" />
<body>

<div class = "headermenu" >
<h3>RajkinBook</h3>
</div>




<div id = "log">
    <h2>Already a Memeber? Now Login ...</h2>
      <form name="input" action="header.php" method="POST">
            Username: <input type="text" name="user_email">
            Password: <input type="text" name="user_password">
            <input type="submit" value="Submit">
      </form>
</div>


<div id = "reg">
    <h2>Register Here</h2>
    <form name="registerform" id="registerform" onsubmit="return false">
        <input type="text" size="40" name="username" id="username" class="auto-clear" placeholder="Username" /><p />
        <input type="text" size="40" name="email" id="email" placeholder="Email id" /> <p />
        <input type="text" size="40" name="pass1" id="pass1" class="auto-clear" placeholder="Password" /><p />
        <input type="text" size="40" name="pass2" id="pass2" placeholder="Repeat Password" /> <p />
        <button id="b2"  onclick="register()">Register</button>
    </form>
</div>


<span id = "status"></span>



</body>
</html>