<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="stylesheet.css" type="text/css">



	<title>SAS</title>
</head>
<body>
	<header>
		<div class="first">
			<div class="logo">
				<img src="image/logonew1.png" alt="sas.png">
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
					<li><a href="logout.php">LOGOUT</a></li>
				<?php endif; ?>

				<?php if(isset($user) && ($utype == 'user')): ?>
					<li><a href="community.php">COMMUNITY</a></li>
					<li><a href='myprofile.php?id=<?php echo $uid;?>'>MY PROFILE</a></li>
					<li><a href='userhome.php?id=<?php echo $uid;?>'>USERHOME</a></li>
					<li><a href="logout.php">LOGOUT</a></li>
				<?php endif; ?>
			</ul>
		</header>