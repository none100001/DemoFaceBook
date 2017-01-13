<?php
include_once("db_conx.php");


$tbl_users = "CREATE TABLE request(
   giver varchar(255) NOT NULL,
   accepter varchar(255) NOT NULL
)";
 

$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
echo "<h3>Request table created OK :) </h3>"; 
} else {
echo "<h3>Request table NOT created :( </h3>"; 
}

?>