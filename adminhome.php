<?php
session_start();

if(!isset($_SESSION['type']) && ($_SESSION['type'] != 'admin')){
	header("location: login.php?notloggedin=true");
}elseif(isset($_SESSION['type']) && ($_SESSION['type'] != 'admin')){
	header("location: userhome.php");
}

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="stylesheet.css">

</head>


<body class="adminbody">
	<?php
	include"connection.php";
	include"header.php";
	?>
	<?php
	include"connection.php";

	$atype = '';

	if(isset($_GET['aid']))
	{
		$aid = $_GET['aid'];
		$qry_row = "SELECT * FROM animal WHERE aid='$aid'";
		$result_row = $conn->query($qry_row);
		$data_row = $result_row->fetch_assoc();
		
		$atype = $data_row['type'];
	}

	?>
	<?php	if(isset($_POST['aupdate']))
	{
		include"connection.php";
		$aid=$_GET['aid'];

		$type= $_POST['select'];
		$name= $_POST['aname'];
		$color= $_POST['acolor'];
		$weight=$_POST['aweight'];
		$image=$_FILES['img']['name'];
		$timg = $_FILES['img']['tmp_name'];

		if($image == ''){
			$qry_up = "UPDATE animal SET type='$type',
			name='$name',color='$color',weight='$weight' WHERE aid='$aid'";
		}else{
			$qry_up = "UPDATE animal SET type='$type',
			name='$name',color='$color',weight='$weight',image='$image' WHERE aid='$aid'";
		}

		
		if($conn->query($qry_up) == FALSE)
		{
			die("Error: ".$conn->error);
		}
		move_uploaded_file($timg,"animal_images/".$image);
		header('location:adminhome.php');
		
	}

	?>



	<div class="animalform">
		<form action="" method="POST" enctype="multipart/form-data">

			<select id="select" name="select" >

				<option value="cat" <?php if($atype == 'cat') echo ' selected'; ?>>Cat</option>
				<option value="dog" <?php if($atype == 'dog') echo ' selected'; ?>>Dog</option>
				<option value="goat" <?php if($atype == 'goat') echo ' selected'; ?>>Goat</option>
				<option value="rabbit" <?php if($atype == 'rabbit') echo ' selected'; ?>>Rabbit</option>
			</select><br><br>


			<input type="text" name="aname" Placeholder="Insert animal name" required="required" value="<?php if(isset($_GET['aid'])){
				echo $data_row['name'];}?>"> </br>


				<input type="text" name="acolor" Placeholder="Insert animal color" required="required" value="<?php if(isset($_GET['aid'])){
					echo $data_row['color'];}?>"><br>

					<input type="text" name="aweight" Placeholder="Insert weight" required="required" value="<?php if(isset($_GET['aid'])){
						echo $data_row['weight'];}?>"><br>

						<input type="file" name="img" value="<?php if(isset($_GET['aid'])){
							echo 'animal_images/'. $data_row['image'];}?>"" /><br /><br />

							
								<input type="submit" name="aregister" value="Register">
							

							
								<input type="submit" name="aupdate" value="Update" id="update">
							

						</form>
					</div class="table">
				
					<?php
					if(isset($_POST['aregister']))
					{
						include"connection.php";

						$type= $_POST['select'];
						$name= $_POST['aname'];
						$color= $_POST['acolor'];
						$weight=$_POST['aweight'];
						$image=$_FILES['img']['name'];
						$timg = $_FILES['img']['tmp_name'];

						$insert="INSERT INTO animal values ('','$type','$name','$color','$weight','$image');";
						if($conn->query($insert) == FALSE)
						{
							die("Error: ".$conn->error);
						}
						move_uploaded_file($timg,"animal_images/".$image);
						echo "<script>alert('Registered')</script>";
					}
					?>
					<div class="table">



						<?php
//select all data from a table
						$select_qry = "SELECT * FROM animal";
						$result = $conn->query($select_qry);
						if($result->num_rows > 0)
						{
							echo "<table border='1'>
							<tr><th>Type</th><th>Name</th><th>Color</th> <th>Weight</th>
							<th>Image</th><th>Operation</th>
							</tr>";
							while($table = $result->fetch_assoc())
							{
								echo "<tr>
								<td>".$table['type']."</td>
								<td>".$table['name']."</td>
								<td>".$table['color']."</td>
								<td>".$table['weight']."</td>
								<td><img src='animal_images/".$table['image']."
								' height='50' width='100' /></td>
								<td><a href='adminhome.php?aid=
								".$table['aid']."'>Edit</a></td>
								
							}
							echo "<table>";
						}
						else
						{
							echo "No data found";
						}


						?>
					</div>

					
				</body>
				</html>