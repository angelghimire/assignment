<html>
<head>
	<meta charset="UTF-8">
	<title>login</title>
	<link rel="stylesheet" href="stylesheet.css">
</head>
<body class="new">
	<div class="loginform">
		<form method="POST">
			<h3>Login Form</h3>
			<label for="username">Username</label></br>
			<input type="text" name="username" required="required" placeholder="Enter your username">	</br>

			<label for="Password">Password</label><br>
			<input type="password" name="password" required="required" placeholder="Enter your password"><br><br>
			<input type="submit" name="login" value="Login">	
			<a href="register.php">Dont have an account ?</a>
		</form>
	</div>
</body>
</html>

<?php
include "mainpageheader.php";
?>

<?php

if(isset($_POST['login']))
{
	include "connection.php";
	$username=$_POST['username'];
	$password=$_POST['password'];

	//checking for empty input fields.
	if(empty($username) || empty($password)){
		header("location: login.php?login=field empty");
		exit();
	}
	else{
		$sql="SELECT * FROM user where username='$username'";
		$result =mysqli_query($conn,$sql);
		$resultcheck=mysqli_num_rows($result);
		if($resultcheck < 1){
			setLoginCookie($username);
			header("location: login.php?login=uerror");
			exit();
		}
		else{
			if($row = mysqli_fetch_assoc($result)){
			//dehasing the hased password .
				$checkhasedpassword=PASSWORD_VERIFY($password,$row['password']);
				if($checkhasedpassword == false){
					setLoginCookie($row['username']);
					header("location: login.php?login=perror");

				}
				elseif ($checkhasedpassword == true){

				//Check if the user last logged in 2 years ago
					$twentyFourMonthsago = strtotime("-24 month", time());
					$lastloggedDate = strtotime($row['lastlogin']);

					$user = $row['username'];
					if($lastloggedDate < $twentyFourMonthsago){
						$delQuery = "DELETE FROM user WHERE username='$user'";
						$conn->query($delQuery);
						header('location:register.php?userexpired=true');
						exit();
					}

					$logindate = date("Y-m-d H:i:s");
					$insert="UPDATE user set lastlogin='$logindate' where username='$user'";
					$conn->query($insert);


					session_start();
					$_SESSION['username']= $row['username'];
					$_SESSION['type']= $row['type'];
					$_SESSION['id']=$row['id'];

					if($_SESSION['type']=="admin")
					{
						header('location:adminhome.php');
					}
					else
					{
						header('location:userhome.php');
					}
				}


			}
		}

	}

}

function setLoginCookie($username){

	if(!isset($_COOKIE[$username])){
		setcookie($username, 2);
	}

	if(isset($_COOKIE[$username]))
	{
		if($_COOKIE[$username] < 3)
		{
			setcookie($username,$_COOKIE[$username]+1,time()+300);
		}
	}    

	if(isset($_COOKIE[$username]))
	{
		if($_COOKIE[$username] >= 3)
		{
			echo "<div class='blockedmsg'>You have been blocked for 5 minutes.</div>";
			die;
		}
	}
	
}


?>