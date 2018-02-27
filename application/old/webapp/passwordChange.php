<?php

session_start(); 

require 'authDB.php';

if( isset($_SESSION['user_id']) ) {
	
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
	
		
		
		if( !empty($_POST['changePwd'])) {
			if( password_verify($_POST['currentPwd'], $results['password'])) {
				/* Changing Password Query */
				$sql = "UPDATE users set password = :password WHERE id = :id";
				$update = $conn->prepare($sql);
				$update->bindParam(':password', password_hash($_POST['changePwd'], PASSWORD_BCRYPT));
				$update->bindParam(':id', $_SESSION['user_id']);
				$update->execute();
				
				$message = "암호 변경됨";
				
				header("Location: index.php#summary");
		} else {
				/* currentPwd wrong */
				$message = "현재 암호 틀림";
			}
		}

	
	}
} else {
	header("Location: login.php");
}




?>

<? include_once('data.php'); ?>
	<? include_once('sum.php'); ?>


<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	
	
		
    <link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css">
	<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
	
	<!--ViewPort-->
	<meta name="viewport" content="width=device-width" />
 
 
	</head>
	
	<body>
	<div data-role="page" id="login">
	  <div data-role="header">
    <a href="#" class="ui-btn-block" data-rel="back">뒤로 가기</a>
	    <h1>혜경결 회비 조회 - 비밀번호 수정</h1>
	    <div class="ui-body">로그인: <?=$loginName ?> 님</div>
	    <a href="logout.php" class="ui-btn-block">Logout</a>
      </div>
	  <div data-role="content">
		
		<?php if( !empty($message) ) { ?>
		<?=$message ?>
		<?php } ?>
		
		<form data-ajax="false" action="passwordChange.php" method="POST">
			
			<div data-role="fieldcontain">
				<label for="currentPwd">현재 암호</label>
				<input type="password" name="currentPwd" id="currentPwd">
			</div>
			<div data-role="fieldcontain">
				<label for="changePwd">바꿀 암호</label>
				<input type="password" name="changePwd" id="changePwd">
			</div>
			<input type="submit" value="수정">
			
		</form>
		
		
		</div>
	   <div data-role="footer" data-theme="d">
			<p>
			<h4> 계좌 잔액(<?php echo("$names[13]".") : "."$sum[13]"); ?>
			</h4>
		  </p>
		  
		  </div>
    </div>
		
		
		
	</body>
</html>