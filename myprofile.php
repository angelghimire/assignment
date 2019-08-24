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
	<?php
	if(isset($_SESSION['id'])){
		$uid = $_SESSION['id'];
	$qry_row = "SELECT * FROM user WHERE id='$uid'";
	$result_row = $conn->query($qry_row);
	$data_row = $result_row->fetch_assoc();
}

?>
<?php
if (isset($_POST['uupdate'])) {
	$registereddate=date('Y-m-d');
     $name = $_POST['name'];
	$birth = $_POST['dob'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$postalcode = $_POST['postalcode'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$pet = $_POST['petname'];
	if($password == ''){
			$updateuser="UPDATE  user SET name='$name',
			dob='$birth',email='$email',address='$address',postalcode='$postalcode',username='$username' WHERE id='$uid'";
					$run=$conn->query($updateuser);
					header("location:userhome.php");
		}
else{
	$password="UPDATE  user SET name='$name',
			dob='$birth',email='$email',address='$address',postalcode='$postalcode',username='$username',password='$password' WHERE id='$uid";
					$run=$conn->query($updateuser);
					header("location:userhome.php");
}


}
?>
<div class="registerform">
	<form method="POST" action="">
		<label for="name">Name<sup>*</sup></label><br>
		<input type="text" required="required" placeholder="Enter your name" name="name" value="<?php if(isset($uid)){
			echo $data_row['name'];}?>"><br>


			<label for="Email">Email<sup>*</sup></label><br>
			<input type="Email" required="required" placeholder="Enter your E-mail" name="email" value="<?php if(isset($uid)){
				echo $data_row['email'];}?>"><br>

				<label for="Dob">Date of birth <sup>*</sup></label><br>
				<input type="date" required="required" placeholder="Enter your date of birth" name="dob"
				value="<?php if(isset($uid)){
					echo $data_row['dob'];}?>"><br>

					<label for="Address">Address <sup>*</sup></label><br>
					<input type="text" placeholder="Enter you Postal Address" required="required" name="address" value="<?php if(isset($uid)){
						echo $data_row['address'];}?>"><br>

						<label for="Postal code">Postal code <sup>*</sup></label><br>
						<input type="text" placeholder="Enter your postal code" required="required" name="postalcode" value="<?php if(isset($uid)){
							echo $data_row['postalcode'];}?>"><br>


							<label for="username">Username <sup>*</sup></label></br>
							<input type="text" name="username" required="required" placeholder="Enter your username" value="<?php if(isset($uid)){
								echo $data_row['username'];}?>">	</br>

								<label for="Password">Password <sup>*</sup></label><br>
								<input type="password" name="password" placeholder="Enter your password"><br>
								<input type="submit" name="uupdate" value="Update">	
								</form>
							</div>
						

					</body>
					</html>