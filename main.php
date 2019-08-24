
<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION['type'])){
	$user = $_SESSION['username'];
	$utype = $_SESSION['type'];
}

?>

<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="stylesheet.css" type="text/css">

	


	<title>SAS</title>
</head>
<body class="mainbody">
	<header>
		<div class="first">
			<div class="logo">
				<img src="image/logonew1.png" alt="sas.png">
			</div>

			<ul class="nav">
				<li class="foractive"><a href="main.php">HOME</a></li>
				<li><a href="#aboutus">ABOUT US</a></li>
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
					<li><a href="logout.php">LOGOUT</a></li>
				<?php endif; ?>
			</ul>		
			<?php
			include "connection.php";

			$query = "SELECT * FROM count";
			$find_count= $conn->query($query);
			while ($row= mysqli_fetch_assoc($find_count)) {
				$current_counts=$row['counts'];
				$new_count =$current_counts + 1;
				$update_count= $conn->query("UPDATE `assignment` . `count` SET `counts`= $new_count");

			}

			?>
			<div class="count">
				<p>Pageviews:<?php echo $new_count;?></p>

			</div>	
			<div class="maintext">
				<h1>SPENCER ANIMAL SHELTER</h1>
				<div class="mainbutton">
					<a href="login.php"><input type="button" name="button"  class="btn btn-primary" value="GET STARTED"></a>
				</div>

			</div>

		</header>

		<div class="slideshow">	
			<script>
				var i= 0;
				var images=[];
				var time=2000;
				images[0]='image/dog.jpg';
				images[1]='image/cat2.jpg';
				images[2]='image/deer.jpg';
				images[3]='image/beer.jpg';

		//chnaging image
		function imgchange(){
			document.slider.src=images[i];
			if(i < images.length - 1){
				i++;
			}
			else{
				i=0;
			}
			setTimeout("imgchange()",time);
		}
		window.onload= imgchange;



	</script>
	<img  name="slider" height="500" width="100%">
</div>

<div class="aboutus" id="aboutus">
	<section class="section section-one">
		<h2>About us </h2>
		<p>
			Spencer Animal Shelter (SAS) is a leading animal shelter and it looks after a range of
			different animals of shapes and sizes. For example, it mainly looks after cats and dogs,
			however it also looks to rehome chickens, rabbits, mice, guinea pigs, goats, sheep and
			more!
			SAS aim to provide the best possible care for animals and promote good welfare and
			responsible pet ownership and they do this through providing support, guidance and
			education to new animal owners. SAS take in unwanted and lost animals and provide
			them with care and shelter and look to find them new homes.
		</p>
	</section>
</div>
<footer>
	<div class="footer">
		<section class="section section-two">


			<!--Footer-->
			<footer class="page-footer font-small stylish-color-dark pt-4 mt-4">

				<!--Footer Links-->
				<div class="container text-center text-md-left">

					<!-- Footer links -->
					<div class="row text-center text-md-left mt-3 pb-3">

						<!--First column-->
						<div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
							<h6 class="text-uppercase mb-4 font-weight-bold">Spencer Animal Shelter </h6>
							<p>Spencer Animal Shelter (SAS) is a leading animal shelter and it looks after a range of
								different animals of shapes and sizes. For example, it mainly looks after cats and dogs,
								however it also looks to rehome chickens, rabbits, mice, guinea pigs, goats, sheep and
								more!
							</p>
						</div>
						<!--/.First column-->



						<hr class="w-100 clearfix d-md-none">

						<!--Third column-->
						<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
							<h6 class="text-uppercase mb-4 font-weight-bold">quick links</h6>
							<p><a href="login.php">Login</a></p>
							<p><a href="register.php">Register</a></p>
							<p><a href="animal.php">Animal</a></p>
							<p><a href="main.php#aboutus">Aboutus</a></p>
							<p><a href="rss.php">RSS feed</a></p>
						</div>
						<!--/.Third column-->

						<hr class="w-100 clearfix d-md-none">

						<!--Fourth column-->
						<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
							<h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
							<p><i class="fa fa-home mr-3"></i> Kathmandu,Nepal</p>
							<p><i class="fa fa-envelope mr-3"></i>Spencer@gmail.com</p>
							<p><i class="fa fa-phone mr-3"></i> +9779852415698</p>
							<p><i class="fa fa-print mr-3"></i> +9779852365214</p>
						</div>
						<!--/.Fourth column-->

					</div>
					<!-- Footer links -->

					<hr>

					<div class="row py-3 d-flex align-items-center">

						<!--Grid column-->
						<div class="col-md-8 col-lg-8">

							<!--Copyright-->
							<p class="text-center text-md-left grey-text">© 2018 Copyright:<strong> Spencer Animal Shelter</strong></p>
							<!--/.Copyright-->

						</div>
						<!--Grid column-->

						<!--Grid column-->
						<div class="col-md-4 col-lg-4 ml-lg-0">

							<!--Social buttons-->
							<div class="text-center text-md-right">
								<ul class="list-unstyled list-inline">
									<li class="list-inline-item"><a href="http://www.facebook.com">
										<img src="image/facebook.png" alt="facebook.jpg">
									</a>
								</li>

								<li class="list-inline-item">
									<a href="http://www.instagram.com">
										<img src="image/instagram.png" alt="twitter.jpg">
									</a>
								</li>
								<li class="list-inline-item">
									<a href="http://www.googleplus.com">
										<img src="image/googleplus.png" alt="googleplus.jpg">
									</a>
								</li>

								<li class="list-inline-item">
									<a href="http://www.twitter.com">
										<img src="image/twitter1.png" alt="twitter.jpg">
									</a>

								</li>

								<li class="list-inline-item">
									<a href="http://www.youtube.com">
										<img src="image/youtube1.png" alt="youtube.jpg">
									</a>



								</ul>
							</div>
							<!--/.Social buttons-->

						</div>
						<!--Grid column-->

					</div>

				</div>

			</footer>
			<!--/.Footer-->


		</footer>
		<!--/.Footer-->

	</section>


</body>

</html>
<script src="js/bootstrap.js">
	
</script>
