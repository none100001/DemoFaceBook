<?php
include_once("db_conx.php");


$tbl_users = "CREATE TABLE wallphoto(
   owner varchar(255) NOT NULL,
   photopath varchar(255) NOT NULL
)";
 

$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
echo "<h3>wallphoto table created OK :) </h3>"; 
} else {
echo "<h3>wallphoto table NOT created :( </h3>"; 
}

?>