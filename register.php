<html>
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="stylesheet.css">
	<?php
	include "header.php";
	?>
</head>
<body class="new">
	<div class="registerform">
		<form method="POST" action
				<h3>Register</h3>
			<label for="name">Name<sup>*</sup></label><br>
			<input type="text" required="required" placeholder="Enter your name" name="name"><br>

			<label for="Email">Email<sup>*</sup></label><br>
			<input type="Email" id="uemail" required="required" placeholder="Enter your E-mail" name="email"  onkeyup="checkValueAlreadyExists('uemail','useremail')"><br>

			<label for="Dob">Date of birth <sup>*</sup></label><br>
			<input type="date" required="required" placeholder="Enter your date of birth" name="dob"><br>

			<label for="Address">Address <sup>*</sup></label><br>
			<input type="text" placeholder="Enter you Postal Address" required="required" name="address"><br>

			<label for="Postal code">Postal code <sup>*</sup></label><br>
			<input type="text" placeholder="Enter your postal code" required="required" name="postalcode"><br>


			<label for="username">Username <sup>*</sup></label></br>
			<input type="text" name="username" required="required" placeholder="Enter your username" id="auser" onkeyup="checkValueAlreadyExists('auser','username')">	</br>

			<div id="showerr"></div>

			<label for="Password">Password <sup>*</sup></label><br>
			<input type="password" name="password" required="required" placeholder="Enter your password"><br><br>

			<label for="pet">Pet name <sup>*</sup></label><br>
			<input type="text" placeholder="Enter pet you adopted" required="required" name="petname"><br>
			<input type="submit" name="register" value="Register">	
		</div>
	</form>

</body>
</html>
<?php
include "connection.php";
if(isset($_POST['register']))
{
	
     $rdate=date('Y-m-d H:i:s');
	$name= $_POST['name'];
	$email= $_POST['email'];
	$dob= $_POST['dob'];
	$address= $_POST['address'];
	$postalcode= $_POST['postalcode'];
	$username= $_POST['username'];
	$password= $_POST['password'];
	$pet=$_POST['petname'];
	

	if (empty($name) || empty($email) || empty($dob) || empty($address) || empty($postalcode) || empty($username) || empty($password))
	{
		header("location: register.php");
		exit();
	}
	else
	{		//checking for input characters.
		if (!preg_match("/^[a-zA-Z]*$/", $username)) {
			header("location: register.php?register=invalid");
			exit();
		}
		else{
				//checkig for email validation
			if(!filter_var($email, FILTER_VALIDATE_EMAIL ))
			{
				header("location: register.php?register=invalidemail");
				exit();
			}
			else{
				$sql="SELECT * FROM USER WHERE username='$username'";
				$result=mysqli_query($conn,$sql);
				$resultcheck = mysqli_num_rows($result);

				if($resultcheck > 0){
					header("location: register.php?register=usertaken");
					exit();
				}
				else{
					//hasing the password
					$hashpassword= password_hash($password, PASSWORD_DEFAULT);

					$insert="INSERT INTO user (name,email,dob,address,postalcode,username,password,type,registereddate,lastlogin,pet) values ('$name','$email','$dob','$address','$postalcode','$username','$hashpassword','user','$rdate','$rdate','$pet');";
					$res=$conn->query($insert);
					
					header("location:login.php");
				}
			}
		}
	}

}

?>
<script>
	function checkValueAlreadyExists(id, type)
	{
		var fieldVal = document.getElementById(id).value;
		var req;
		if(window.XMLHttpRequest)
		{
			req = new XMLHttpRequest()
		}
		else
		{
			req = new ActiveXObject("Microsoft.XMLHTTP");
		}

		req.onreadystatechange=function()
		{
			if (req.readyState==4 && req.status==200) 
			{
				if(req.responseText)
				{
					document.getElementById(id).value = '';
					alert(req.responseText);
				}

			}
		}
		req.open("GET","ajax.php?val=" + fieldVal + "&type=" + type,true);
		req.send();
	}
	
</script>



