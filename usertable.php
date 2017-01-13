<?php
include_once("db_conx.php");


$tbl_users = "CREATE TABLE user(
   username varchar(255) NOT NULL,
   password varchar(32) NOT NULL,
   email varchar(255) NOT NULL,
   status varchar(200) NOT NULL
)";
 

$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
echo "<h3>user table created OK :) </h3>"; 
} else {
echo "<h3>user table NOT created :( </h3>"; 
}

?>