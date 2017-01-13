<html>
<body style = color:RED>
<?php
	
	include_once("db_conx.php");

	$sql = "SELECT * FROM user";
	$query = mysqli_query($db_conx, $sql);

	echo "<CENTER>";
	echo "<ul>";
	while($row = mysqli_fetch_array($query)){
		echo "<li><a href = profile.php?e=".$row["username"].">".$row["username"]."</a></li>";
	}
	echo "</ul>";
	echo "<CENTER>";

?>
</body>
</html>