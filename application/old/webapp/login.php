<?php

session_start();

if( isset($_SESSION['user_id']) ) {
	header("Location: index.php#main");
}

require 'authDB.php';

if(!empty($_POST['id']) && !empty($_POST['pwd'])):
	$conn->query("set names utf8;");
	$records = $conn->prepare('SELECT id, name, password FROM users WHERE name = :name');
	$records->bindParam(':name', $_POST['id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['pwd'], $results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		header("Location: index.php#main");

	} else {
		$message = 'Sorry, those credentials do not match';
	}

endif;

?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	
	<? include_once('data.php'); ?>
	<? include_once('sum.php'); ?>
	
	<!--ViewPort-->
		<meta name="viewport" content="width=device-width" />
		
    <link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
	</head>
	
	<body>
	<div data-role="page" id="login">
	  <div data-role="header">
    <a href="#" class="ui-btn-block" data-rel="back">뒤로 가기</a>
	    <h1>혜경결 회비 조회 - 로그인</h1> 
	    
      </div>
	  <div data-role="content">
		<? if(!empty($message)) {
		  	echo("$message"); 
		   
		} ?>
		<!-- 로그인 값이 null인지 검사하는 javascript 코드 넣을 예정 -->
		<form data-ajax="false" action="login.php" method="POST">
			
			<div data-role="fieldcontain">
				<label for="name">이름</label>
				<input type="text" name="id" id="name">
			</div>
			<div data-role="fieldcontain">
				<label for="pwd">암호</label>
				<input type="password" name="pwd" id="pwd">
			</div>
			<input type="submit" value="login">
			
		</form>
		
		
		</div>
	  <div data-role="footer">
	        <a href="/phpmyadmin/" value="db" class="ui-btn-inline"  data-ajax="false" data-type="horizontal">db</a>
		
		<a href="sms:010-3310-3784" class="ui-btn-inline" data-ajax="false" data-type="horizontal">문자보내기</a>
		<h2> </h2>
      </div>
    </div>
		
		
		
	</body>
</html>
