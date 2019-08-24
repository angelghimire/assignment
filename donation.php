<?php
session_start();

if(!isset($_SESSION['type']) && ($_SESSION['type'] != 'admin')){
	header("location: login.php?notloggedin");
}

?>
<?php
include"header.php";
include"connection.php";


if(isset($_GET['bid']) && ($_GET['status'] == 'approved'))
{
	$bid = $_GET['bid'];
	$qry_row = "UPDATE booking set status='Approved' WHERE bid='$bid'";
	$result_row = $conn->query($qry_row);
	header("location:donation.php");

}
else if(isset($_GET['bid'])  && ($_GET['status'] == 'disapproved'))
{
	$bid = $_GET['bid'];
	$qry_row = "UPDATE booking set status='Disapproved' WHERE bid='$bid'";
	$result_row = $conn->query($qry_row);
	header("location:donation.php");
}


?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Donations</title>
</head>
<body class="dbody">
	<div class="dtotal">
		<?php
		$total=	"SELECT SUM(donationamount) AS Total_donation FROM booking";
		$result_total = $conn->query($total);
		$fetch_total=$result_total->fetch_assoc();
		echo "Total_donation::$".$fetch_total['Total_donation'];
		
		
		?>
		
	</div>

	<div class="donate">
		<table>
			<?php

		
	
			$select_qry = "SELECT * FROM booking as b INNER JOIN user as u INNER JOIN animal as a on b.uid = u.id AND b.aid=a.aid";
			$result = $conn->query($select_qry);
			if($result->num_rows > 0)
			{

				echo "<table border='2'>
				<tr><th>Username</th><th>Pet Name</th><th>Donation Amount</th><th>Status</th><th>Operation</th>
				</tr>";
				while($row = $result->fetch_assoc())
				{
					echo "<tr>";

					echo "<td>".$row['username']. "</td>";
					echo "<td>".$row['name']."</td>";
					echo "<td>".$row['donationamount']."</td>";

					echo "<td>".$row['status']."</td>";
		


					if($row['status'] == 'Pending'){
						echo "<td><span id='span'><a href='donation.php?bid=
						".$row['bid']."&status=approved'>Approve</a></span><span id='span'><a href='donation.php?bid=
						".$row['bid']."&status=disapproved'>Disapprove</a></span></td>";
					}
					

					echo "</tr>";

				}
				echo "<table>";

			}
			?>
		</table>
	</div>
</body>
</html>