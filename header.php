<?php
if(isset($_SESSION['username']) && isset($_SESSION['type'])){
	$user = trim($_SESSION['username']);
	$utype = trim($_SESSION['type']);

}
?>

<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="stylesheet.css" type="text/css">
	<title>SAS</title>
</head>
<body>
	
	<div class="first">
		<div class="logo">
			<img src="image/logonew1.png" alt="sas.png" height="50">
		</div>
		<ul class="nav">
			<li class="foractive"><a href="main.php">HOME</a></li>
			<li><a href="main.php#aboutus">ABOUT US</a></li>
			<li><a href="animal.php">ANIMALS</a></li>
			
			<?php if(!isset($user)): ?>
				<li><a href="login.php">LOGIN</a></li>
				<li><a href="register.php">REGISTER</a></li>
			<?php endif; ?>

			<?php if(isset($user) && ($utype == 'admin')): ?>
				<li><a href="adminhome.php">ADMINISTRATE</a></li>
				<li><a href="donation.php">DONATIONS</a></li>
					<li><a href="logout.php">LOGOUT</a></li>

			<?php endif; ?>

			<?php if(isset($user) && ($utype == 'user')): ?>
				<li><a href="community.php">COMMUNITY</a></li>
				<li><a href='myprofile.php'>MY PROFILE</a></li>
				<li><a href='userhome.php'>USERHOME</a></li>
				<li><a href='favorites.php'>MY FAVORITES</a></li>

				<li><a href="logout.php">LOGOUT</a></li>
			<?php endif; ?>
		</ul>
	</div>

	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>

