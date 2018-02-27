
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>account</title>
		
		<!-- data file -->
		<?php 
			include_once('../../webapp/data.php');
			include_once('../sum.php');
		?>
		
		<!-- for login.. -->
		<?
			include('../session.php');
		?>

		<!--ViewPort-->
		<meta name="viewport" content="width=device-width" />
 
		
		<meta charset="utf-8">
		<title>account</title>
   		
		<link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css">
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
	</head>

	<body>
	
	<!-- Start of login page -->
	<div data-role="page" id="login">
	  <div data-role="header">
		<h1>혜경결 회비 조회 - 로그인</h1>
	  </div>

	  <!-- Sstart of Login Form -->
	  <form method="post" data-ajax="false" action="../login/loginCheck.php" >
		  <!-- Start of ID input -->
		  <div data-role="fieldcontain">
			<label for="idInput"> 이름 </label>
			  <input type="text" name="user_id" id="idInput" value=""></input>
		  </div>
		  <!-- End of ID input -->

		<!-- Start of Password input -->
		  <div data-role="fieldcontain">
			  <label for="pwdInput"> PW </label>
			  <input type="password" name="user_pwd" id="pwdInput" value=""></input>
		  </div>
		  <!-- End of Password input -->
		  
		  <input type="submit" id="submit" value="login" />

		</form>
  <!-- End of Login Form -->
  
  <div data-role="footer" data-theme="d">
    <h4> 계좌 잔액(<?php echo("$names[13]".") : "."$sum[13]"); ?></h4>
  </div>
</div>
<!-- End of login page -->


		<!-- Start of 'IDnull' page -->
		
	<div data-role="page" id="IDnull">
			<div data-role="header">
				<h1>혜경결 회비 조회</h1>
			</div>
			<div data-role="content">
				<p style="text-algin: center;">ID가 입력되지 않았습다.</p>
			</div>
			<a href="#login" data-type="button">다시 로그인</a>
		</div>
		<!-- End of 'IDnull' page -->

		<!-- Start of 'PWDnull' page -->
		<div data-role="page" id="PWDnull">
			<div data-role="header">
				<h1>혜경결 회비 조회</h1>
			</div>
			<div data-role="content">
				<p style="text-algin: center;">비밀번호가 입력되지 않았습니다.</p>
			</div>
			<? header("Location: ../login/login.php"); ?>	
		</div>
		<!-- End of Not 'PWDnull' page -->
		
		<!-- Start of 'loginFail' page -->
		<div data-role="page" id="loginFail">
			<div data-role="header">
				<h1>혜경결 회비 조회</h1>
			</div>
			<div data-role="content">
				<p style="text-algin: center;">ID 혹은 암호가 잘못되었습니다.</p>
			</div>
			<? header("Location: ../login/login.php"); ?>	
		</div>

</body>
</html>
