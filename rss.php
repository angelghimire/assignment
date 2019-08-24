<?php
include 'connection.php';
header("content-type:text/xml");
echo "<?xml version='1.0' ?>";
$query_select = "SELECT * FROM animal";
$run= $conn->query($query_select);
echo "<animal>";
while($fetch= $run->fetch_assoc())
{
	echo "<id>".$fetch['aid']."</id>";
	echo "<name>".$fetch['name']."</name>";
	echo "<type>".$fetch['type']."</type>";
	echo "<weight>".$fetch['weight']."</weight>";
	echo "<color>".$fetch['color']."</color>";
}
echo "</animal>";
?>