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
	<title>My Favorites</title>
	<link rel="stylesheet" href="stylesheet.css">

</head>
<body class="userbody">
	<div class="welcome">
		<?php 
		$user=$_SESSION['username'];
		$uid=$_SESSION['id'];

		$cookie_data = $_COOKIE;
		$user_favs = [];
		foreach($cookie_data as $key => $data){
			$expl = explode('_', $key);
			if(($expl[0] == $uid) && $data){
				$user_favs[] = $expl[1];
			}
		}
		echo "My Favorites";

		?>
	</div>
	<div id="myanimals">
		<?php

		$ids = 0;
		if(!empty($user_favs)){
		
			$ids = implode(',', $user_favs);
		}
		
		$qry_sel = "SELECT * FROM animal WHERE aid IN ($ids)";
		$result = $conn->query($qry_sel);
		if($result->num_rows > 0)
		{
			while($select = $result->fetch_assoc())
			{

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
		;
		?>

	</div>

</body>
</html>