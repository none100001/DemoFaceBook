<?php
$db_conx = mysqli_connect("localhost", "iam", "raj", "rajkinbook");
// Evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
}

?>