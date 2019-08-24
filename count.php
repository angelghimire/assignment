<?php
include "connection.php";

$query = "SELECT * FROM count";
$find_count= $conn->query($query);
while ($row= mysqli_fetch_assoc($find_count)) {
	$current_counts=$row['counts'];
    $new_count =$current_counts + 1;
    $update_count= $conn->query("UPDATE `assignment` . `count` SET `counts`= $new_count");
    echo $new_count;
}
?>