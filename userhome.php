<?php
session_start();

if(!isset($_SESSION['type']) && ($_SESSION['type'] != 'user')){
	header("location: login.php?notloggedin=true");
}elseif(isset($_SESSION['type']) && ($_SESSION['type'] != 'user')){
	header("location: adminhome.php");
}

?>
<?php
include 'connection.php';
include 'header.php';
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="stylesheet.css">

</head>
<body class="userbody">
	<div class="welcome">
		<?php 
		$user=$_SESSION['username'];
		$uid=$_SESSION['id'];
		echo "Welcome"."   ".$user;
		$select= "SELECT * FROM user WHERE id='$uid'";
		$res = $conn->query($select);
		$run = $res->fetch_assoc();
		$name=$run['name'];
		$email=$run['email'];
		$address=$run['address'];
		$postalcode=$run['postalcode'];
		$username=$run['username'];
		$dob=$run['dob'];

		
		?>
	</div>
	<div class="intro">
		<div class="logo">
			<img src="image/login.png"  alt="logo.png">
		</div>
		<div class="parameters">
			<p class="pname"><?php echo "Name:".$name?></p>
			<p><?php echo "Date Of Birth:".$dob?></p>
			<p class="ppname"><?php echo "Email:".$email?></p>
			<p class="pname"><?php echo "Address:".$address?></p>
			<p class="pname"><?php echo "Postal-Code:".$postalcode?></p>
			<p class="pname"><?php echo "Username:".$username?></p>
		</div>

		
	</div>
	<div id="myanimals">
		<?php

		$qry_sel = "SELECT * FROM booking as b INNER JOIN user as u INNER JOIN animal as a on b.uid = u.id AND b.aid=a.aid";
		$result = $conn->query($qry_sel);
		if($result->num_rows > 0)
		{
			while($select = $result->fetch_assoc())
			{
				if ($select['status'] !=='Disapproved' && $select['status'] !=='Pending')  {



					echo "<div class='ind_animal' style='height:350px;width:250px;
					border:2px solid silver;margin: 30px 10px; 
					float:left;box-shadow: black 3px 3px 3px;' data-atype=". $select['type'] .">
					<img src='animal_images/".$select['image']."
					' height='220' width='245' />
					<p align='center' class='manage'><b>Name: </b> ".$select['name']."</p>
					<p align='center'class='manage'><b>color: </b> ".$select['color']."</p>
					<p align='center'class='manage'><b>Weight: </b> ".$select['weight']."</p></div>";
				}
			}
			}
			;
				?>

			</div>

		</body>
		</html>