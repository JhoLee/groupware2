<?php

session_start(); 

require 'authDB.php';

if( isset($_SESSION['user_id']) ) {
	echo("<script type='text/javascript'> alert($_SESSION'[user_id]');</script>");
	$conn->query("set names utf8;");
	$records = $conn->prepare('SELECT id, name, password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	
	$user = NULL;
	$message = "";
	
	if( count($results) > 0) {
		$user = $results;
		$loginName = $results['name'];
	}
}

?>

<!doctype html>
<html>
	
	<head>
		<!-- data file -->
		<?php 
			include_once('data.php');
			include_once('sum.php');
		?>
		
		
		
		
		
		<!--ViewPort-->
		<meta name="viewport" content="width=device-width" />
 
		
		<meta charset="utf-8">
		<title>account</title>
   		
  	    <!-- JQuery Mobile URL -->
   	    <link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css">
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
		
	</head>

	<body>
		
		
	<?php if( !empty($user) ): ?>

			
		<!-- Start of main page -->
		<div data-role="page" id="main">
		  <div data-role="header">
		  <a href="#" class="ui-btn-block" data-rel="back">뒤로 가기</a>
			  <h1>혜경결 회비 조회 </h1>
			  <p class="ui-body">로그인: <?=$loginName ?> 님</p>
		  	  <a class="ui-btn-block" href="logout.php">로그아웃</a>
			  		
		  </div>
		  <div data-role="content">
		  
		  		
		<?php if( !empty($message) ) { ?>
		<?=$message ?>
		<?php } ?>
		
			<ul style="list-style-type:none;" data-role="listview" data-inset="true">


			<li>
			<!-- 김기담 -->  
				<a href="user01.php">
					<h3> <?php echo($names[1]); ?></h3>
					<?php 
						if($loginName == "김기담" ||
						   $loginName == "정혜경" ||
						   $loginName == "이주호" ||
						   $loginName == "$names[1]") {
							echo("<p>"."$sum[1]"."</p>");
						}
					?>
				</a>
			</li>

		   <li>
			<!-- 김제린 -->  
				<a href="#page">
					<h3> <?php echo($names[2]); ?></h3>
					<p> <?php echo("$sum[2]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 김헵시바 -->  
				<a href="#page">
					<h3> <?php echo($names[3]); ?></h3>
					<p> <?php echo("$sum[3]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 박재현 -->  
				<a href="#page">
					<h3> <?php echo($names[4]); ?></h3>
					<p> <?php echo("$sum[4]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 양지원 -->  
				<a href="#page">
					<h3> <?php echo($names[5]); ?></h3>
					<p> <?php echo("$sum[5]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 이건 -->  
				<a href="#page">
					<h3> <?php echo($names[6]); ?></h3>
					<p> <?php echo("$sum[6]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 이주호 -->  
				<a href="#page">
					<h3> <?php echo($names[7]); ?></h3>
					<p> <?php echo("$sum[7]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 전민석 -->  
				<a href="#page">
					<h3> <?php echo($names[8]); ?></h3>
					<p> <?php echo("$sum[8]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 정원영 -->  
				<a href="#page">
					<h3> <?php echo($names[9]); ?></h3>
					<p> <?php echo("$sum[9]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 정혜경 -->  
				<a href="../account02/user10.php">
					<h3> <?php echo($names[10]); ?></h3>
					<p> <?php echo("$sum[10]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 한종현 -->  
				<a href="#page">
					<h3> <?php echo($names[11]); ?></h3>
					<p> <?php echo("$sum[11]"); ?></p>
				</a>
			</li>	        

			<li>
			<!-- 허채원 -->  
				<a href="#page">
					<h3> <?php echo($names[12]); ?></h3>
					<p> <?php echo("$sum[12]"); ?></p>
				</a>
			</li>	        

			</ul>

			<!-- EOL -->

		  </div>
		  <div data-role="footer" data-theme="d">
		
			<h4> 계좌 잔액(<?php echo("$names[13]".") : "."$sum[13]"); ?>
			
		  
			  </h4>
		  <a class="ui-btn-block-b" href="passwordChange.php">비밀번호 수정</a>
		  
		  </div>
		</div>
		<!-- End of Main Page -->
		
		




	<?php else: ?>
		<?php header("Location: ../login03/login.php"); ?>
	<?php endif; ?>
	
	</body>
	
</html>
