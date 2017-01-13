<?php

include_once("db_conx.php");
session_start();
$visitor = "";
$user = "";
if (isset($_SESSION["user_email"]) && isset($_SESSION["user_password"])) {
   $visitor = $_SESSION["user_email"];

}


if(isset($_FILES["profilepic"])){
	$name = "pro";
	mkdir("userdata/pictures/$name");

	move_uploaded_file($_FILES["profilepic"]["tmp_name"],"userdata/pictures/$name/".$_FILES["profilepic"]["name"] );

	$r = $_FILES["profilepic"]["name"];

	$sql = "INSERT INTO profilephoto VALUES ('$visitor','$r')";
	$query = mysqli_query($db_conx, $sql);

	echo "Done";
}

if(isset($_FILES["wallpic"])){
	$name = "wall";
	mkdir("userdata/pictures/$name");

	move_uploaded_file($_FILES["wallpic"]["tmp_name"],"userdata/pictures/$name/".$_FILES["wallpic"]["name"] );

	$r = $_FILES["wallpic"]["name"];

	$sql = "INSERT INTO wallphoto VALUES ('$visitor','$r')";
	$query = mysqli_query($db_conx, $sql);

	echo "Done";
}


?>