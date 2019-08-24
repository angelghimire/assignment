<?php
session_start();

if(isset($_POST['favourites'])){
	$animal_id = $_POST['animal_id'];
	$user_id = $_POST['user_id'];
	$cookie_val = $user_id .'_'. $animal_id;
	setcookie($cookie_val, true);
	header("location:animal.php");
}

if(isset($_POST['nofavourites'])){
	$animal_id = $_POST['animal_id'];
	$user_id = $_POST['user_id'];
	$cookie_val = $user_id .'_'. $animal_id;
	setcookie($cookie_val, false);
	header("location:animal.php");
}


?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Animals</title>
	<link rel="stylesheet" href="stylesheet.css">
</head>
<body class="animal">
	<?php
	include 'connection.php';
	include 'header.php';
	?>
	
</body>
</html>
<div class="animals">
	

	<?php
//select all data from a table
	$qry_sel = "SELECT * FROM animal";
	$result = $conn->query($qry_sel);
	if($result->num_rows > 0)
	{
		while($data = $result->fetch_assoc())
		{

			$uid= isset($_SESSION['id']) ? $_SESSION['id'] : 0;
			$utype = isset($_SESSION['type']) ? $_SESSION['type'] : 'nouser';
			$aid = $data['aid'];
			$qry_animal_booked = "SELECT * FROM booking WHERE uid='$uid' AND aid='$aid'";
			$result_booked = $conn->query($qry_animal_booked);

			echo "<div class='ind_animal' style='height:380px;width:250px;
			border:2px solid silver;margin: 30px 10px; 
			float:left;box-shadow: black 3px 3px 3px;' data-atype=". $data['type'] .">
			<img src='animal_images/".$data['image']."
			' height='210' width='245'/>
			<p align='center' class='manage'><b>Name: </b> ".$data['name']."</p>
			<p align='center'class='manage'><b>color: </b> ".$data['color']."</p>
			<p align='center'class='manage'><b>Weight: </b> ".$data['weight']."</p>";

			if(($utype == 'user') && ($result_booked->num_rows < 1)){
				echo "<p align='center' class='book-btn'><button type='button' class='btn btn-primary bookBtn' data-toggle='modal' data-target='#myModal' data-id='".$data['aid']."'>BOOK</button></p>";

			}
			echo "<form action='' method='POST'>";

			echo "<input type='hidden' name='animal_id' value='$aid'>";
			echo "<input type='hidden' name='user_id' value='$uid'>";
			if(isset($utype) && ($utype=='user')){



			if(!isset($_COOKIE[$uid.'_'. $aid])){
				echo "<input type='submit' class='btn btn-outline-primary waves-effect fav-btn' name='favourites' style='margin-left:27; font-size:16px; color:black;'  value='Favorite'>";
			}else{
				echo "<input type='submit' class='btn btn-outline-danger waves-effect fav-btn' name='nofavourites' style='margin-left:27; font-size:16px; color:black;'  value='Unfavorite'>";
			}
}
			echo "</form>";
			

			echo "</div>";
		}
	}

	?>
</div>
<div class="animal_select">
	<label for="animal_sel">Filter Animal  By Type</label>
	<select name="animal_sel" id="animal_sel">
		<option value="all">All</option>
		<option value="cat">Cat</option>
		<option value="dog">Dog</option>
		<option value="goat">Goat</option>
		<option value="rabbit">Rabbit</option>
	</select>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Book Now</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<form id="bookingForm">

					<div class="form-group">
						<label for="bccard">Credit card no:</label>
						<input type="number" class="form-control form-control-sm" id="bccard" name="bccard" required min="1">
					</div>

					<div class="form-group">
						<label for="bdonation">Donation Amount:</label>
						<input type="number" class="form-control form-control-sm" id="bdonation" name="bdonation" required min="1">
					</div>
					<input type="submit" id="bookSubmit" class="btn btn-primary btn-sm" data-id="0"><br>
				</form>
			</div>
		</div>			
		<!-- </div> -->
	</div>

	<script type="text/javascript">
		jQuery('.bookBtn').click(function(){
			var aid = jQuery(this).attr('data-id');
			jQuery('#bookSubmit').attr('data-id', aid);

			jQuery('#myModal').find('input[type="number"]').val('');
		});

		jQuery('#bookSubmit').click(function(e){
			var bccard = jQuery('#bccard').val();
			var bdonation = jQuery('#bdonation').val();
			var aid = jQuery(this).attr('data-id');

			if(bccard != '' && bdonation != ''){
				e.preventDefault();
				jQuery.post( "booking.php",
					{aid:aid, bccard:bccard, bdonation:bdonation}
					).done(function(data){
						jQuery('#myModal').modal("toggle");
						$("button[data-id='" + aid + "']").parent().remove();		
						alert(data);
					});
				}
			});

		jQuery('#animal_sel').change(function(e){
			var selVal = jQuery(this).val();

			if(selVal == 'all'){
				jQuery(".ind_animal").fadeIn('slow');
			}else{
				jQuery(".ind_animal").fadeOut('slow');
				jQuery(".ind_animal[data-atype='" + selVal + "']").fadeIn('slow');
			}
			
		})
		
	</script>

</body>
</html>