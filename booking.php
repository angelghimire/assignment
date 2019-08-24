
<?php
session_start();
$uid= $_SESSION['id'];

$aid=$_POST['aid'];
$creditno=$_POST['bccard'];
$damount=$_POST['bdonation'];

include "connection.php";



$insert="INSERT INTO BOOKING values('', '$uid','$aid','Pending','$creditno','$damount')";
if($conn->query($insert)){
	echo "Animal Booked.";
	exit;
}

?>
