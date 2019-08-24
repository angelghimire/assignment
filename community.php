<?php
session_start();

include 'connection.php';
include 'header.php';

if(!isset($_SESSION['type'])){
	header("location: login.php?notloggedin=true");
}elseif(isset($_SESSION['type']) && ($_SESSION['type'] != 'user')){
	header("location: adminhome.php");
}

if(isset($_POST['questionSubmit'])){
	$qa = htmlentities($_POST['question'], ENT_QUOTES);
	$qa_type = 'question';
	$parent = 0;
	$fuid = $_SESSION['id'];	
	$date= date('Y:m:d');

	$insert="INSERT INTO forum values ('','$qa','$qa_type','$parent','$fuid','$date');";
	$res=$conn->query($insert);

	if(isset($_GET['page'])){
		$pg = $_GET['page'];
		header("location:community.php?page=$pg");
	}else{
		header("location:community.php");
	}

	
}

if(isset($_POST['replytoQuestion'])){
	$qa = $_POST['reply'];
	$qa_type = 'answer';
	$parent = $_POST['qid'];
	$fuid = $_SESSION['id'];	
	$date= date('Y:m:d');

	$insert="INSERT INTO forum values ('','$qa','$qa_type','$parent','$fuid','$date');";
	$res=$conn->query($insert);

	if(isset($_GET['page'])){
		$pg = $_GET['page'];
		header("location:community.php?page=$pg");
	}else{
		header("location:community.php");
	}
}

$start=0;
$max=3;
$qry="SELECT * FROM forum WHERE qa_type='question'";
$res=$conn->query($qry);
$total=$res->num_rows;
$pages = ceil($total/$max);

if(isset($_GET['page']))
{
	$start=($_GET['page'] - 1) * $max;
}

$sql_question="SELECT * FROM forum WHERE qa_type='question' LIMIT $start,$max";
$result_questions=$conn->query($sql_question);
$resultcheck_no_question = mysqli_num_rows($result_questions);

?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Community</title>
	<link rel="stylesheet" href="stylesheet.css">
</head>
<body class="cbody">

	<div class="forumbody">

		<div class="inputsquestion">
			<form id="questionForm" method="POST" action="">
				<div class="form-group">
					<textarea class="form-control" rows="2" id="cquestion" name="question" placeholder="POST YOUR QUESTION HERE..." required></textarea>
				</div>
				<input type="submit" id="questionSubmit" name="questionSubmit" class="btn btn-primary btn-sm">

			</form>
			<br>
		</div>

		<div class="inputs answers">
			
			<?php
			if($resultcheck_no_question > 0){
				$all_questions = $result_questions->fetch_all(MYSQLI_ASSOC);
				foreach($all_questions as $question){
					?>
					<div class="question-list">
						<h5><?php echo $question['qa']; ?></h5>
						<ul>
							<div class="answer-list">
								<strong style="font-size:18px;">Replies</strong>
								<?php
								$afid = $question['fid'];
								$sql_answer="SELECT * FROM forum WHERE qa_type='answer' AND parent='$afid'";
								$result_answers=$conn->query($sql_answer);
								$resultcheck_no_answer = mysqli_num_rows($result_answers);
								if($resultcheck_no_answer > 0){
									$all_answer = $result_answers->fetch_all(MYSQLI_ASSOC);
									foreach($all_answer as $answer){
										?>
										<li>
											<div class="each-answer">

												<p><h7><?php echo $answer['qa']; ?></h7><p>
												</div>
											</li>
											<?php
										}
									}
									?>
									<div class="question-reply">
										<form method="POST" action="" name="replyQuestion">
											<input type="hidden" name="qid" value='<?php echo $afid; ?>'>
											<textarea name="reply" placeholder="POST YOUR REPLY HERE..." required='required' rows="2" cols="40"></textarea>
											<input type="submit" name="replytoQuestion" class="btn btn-secondary btn-sm reply-btn">
										</form>
									</div>
								</div>
							</ul>
						</div>

						<?php
					}
				}

				?>
				
			</div>

			<div class="pagination-links">
				<?php
				for ($i=1;$i<=$pages;$i++)
				{
					if($i == 1 && !isset($_GET['page'])){
						echo "<a href='community.php?page=$i' class='active'>$i</a>";
					}elseif($i != 1 && !isset($_GET['page'])){
						echo "<a href='community.php?page=$i'>$i</a>";
					}elseif(isset($_GET['page'])){
						$page_sel = $_GET['page'];
						if($i == $page_sel){
							echo "<a href='community.php?page=$i' class='active'>$i</a>";
						}else{
							echo "<a href='community.php?page=$i'>$i</a>";
						}						
					}
					
				}
				?>
			</div>


	

		<div id="petgifts">
			<p>Pets Gifts</p>
			<script>
				var i= 0;
				var images=[];
				var time=2000;
				images[0]='image/rugs.jpg';
				images[1]='image/baskets2.jpg';
				images[2]='image/baskkets.jpg';
				images[3]='image/gifts2.jpg';

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
	<img  name="slider" height="500" width="130%">
		</div>
			</div>
		
	</body>

	</html>