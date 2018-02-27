<!doctype html>
<html>
<head>
<!-- data file -->
		<?php 
			include_once('../../webapp/data.php');
			include_once('../../webapp/sum.php');
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
	<div data-role="page" id="login">
	  <div data-role="header">
		<h1>혜경결 회비 조회 - 로그인</h1>
	  </div>
	  <div data-role="content">내용</div>
	  <div data-role="footer" data-theme="d">
			<h4> 계좌 잔액(<?php echo("$names[13]".") : "."$sum[13]"); ?></h4>
			<a href-"logout.php">로그아웃</a></p>
			</div>
	</div>
</body>
</html>
