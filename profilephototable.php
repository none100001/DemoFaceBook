<?php
include_once("db_conx.php");


$tbl_users = "CREATE TABLE profilephoto(
   owner varchar(255) NOT NULL,
   photopath varchar(255) NOT NULL
)";
 

$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
echo "<h3>profilephoto table created OK :) </h3>"; 
} else {
echo "<h3>profilephoto table NOT created :( </h3>"; 
}

?>








