<?php
$conn =new mysqli("127.0.0.1","root","","assignment");

if($conn->connect_error)
{
	die("Connection Failed: ".$conn->connect_error);
}


?>