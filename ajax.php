<?php
include "connection.php";
$value = $_GET['val'];
$type = $_GET['type'];

if($type == 'username'){
	$qry = "SELECT * FROM user WHERE username='$value'";
	$res = $conn->query($qry);
	if($res->num_rows > 0)
	{
		echo "Username already exists.";
	}
}elseif($type == 'useremail'){
	$qry = "SELECT * FROM user WHERE email='$value'";
	$res = $conn->query($qry);
	if($res->num_rows > 0)
	{
		echo "Email already exists.";
	}
}


?>