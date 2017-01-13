<?php
include_once("db_conx.php");


$tbl_users = "CREATE TABLE post(
   fromname varchar(255) NOT NULL,
   posts varchar(32) NOT NULL,
   toname varchar(255) NOT NULL
)";
 

$query = mysqli_query($db_conx, $tbl_users);
if ($query === TRUE) {
echo "<h3>post table created OK :) </h3>"; 
} else {
echo "<h3>post table NOT created :( </h3>"; 
}

?>