<?php

require 'authDB.php';

	if(!empty($_POST["id"]) && !empty($_POST["pwd"])) {
		/* ID & pwd != null */
		$conn->query("set names utf8");
		$sql = "INSERT INTO users (name, password) VALUES(:id, :pwd)";
		$stmt =$conn->prepare($sql);
		
		$stmt->bindParam(':id', $_POST['id']);
		$stmt->bindParam(':pwd', password_hash($_POST['pwd'], PASSWORD_BCRYPT));
		
		if($stmt->execute()) {
			die('Success');
			
		} else {
			die('Failed');
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	
	<? include_once('data.php'); ?>
	<? include_once('sum.php'); ?>
		
    <link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
	</head>
	
	<body>
	<div data-role="page" id="login">
	  <div data-role="header">
    <a href="#" class="ui-btn-block" data-rel="back">뒤로 가기</a>
	    <h1>혜경결 회비 조회 - 가입</h1>
      </div>
	  <div data-role="content">
		
		
		<form data-ajax="false" action="register.php" method="POST">
			
			<div data-role="fieldcontain">
				<label for="name">이름</label>
				<input type="text" name="id" id="name">
			</div>
			<div data-role="fieldcontain">
				<label for="pwd">암호</label>
				<input type="password" name="pwd" id="pwd">
			</div>
			<input type="submit" value="register">
			
		</form>
		
		
		</div>
	  <div data-role="footer">
	    <h4>바닥글</h4>
      </div>
    </div>
		
		
		
	</body>
</html>