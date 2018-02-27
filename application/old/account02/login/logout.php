
<!DOCTYPE html>
<? session_start(); ?>

<html>
	
		
	<head>
		<!-- data file -->
		<?php 
			include_once('data.php');
			include_once('../sum.php');
		?>
		
		<!-- session -->
		<?php
			include("../session.php");
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
	
		<!-- 세션에 로그인 정보가 없는 경우 -->
		<? if(!isset($_SESSION["user_id"]) || !isset($_SESSION["user_pwd"])) { ?>
		
		<!-- Start of Not login page -->
		<div data-role="page" id="notlogin">
			<div data-role="header">
				<h1>혜경결 회비 조회</h1>
			</div>
			<div data-role="content">
				<p style="text-algin: center;">로그인되ji지 않았습니다.</p>
			</div>
			
			<?php echo "<script> document.location.href='../login/login.php';</script>";
			?> 
			
			<div data-role="footer">
			</div>
			
		</div>
		<!-- End of Not login page -->
		
		<!-- 현재 세션 데이터를 지우기 -->
		<? } else { ?>
			<? session_destroy(); ?>
			
			<!-- Start of logout page -->
			<div data-role="page" id="logout">
				<div data-role="header">
					<h1>혜경결 회비 조회</h1>
				</div>
				<div data-role="content">
					<p style="text-algin: center;">로그아웃 되었습니다.</p>
				</div>
				<div data-role="footer">
					<? header("Location: ../login/login.php"); ?>	
				</div>
			</div>s
			<!-- End of Not login page -->		
			
			
	</body>

</html>