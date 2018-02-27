<!doctype html>

<html>
<head>
<meta charset="utf-8">
<title>무제 문서</title>
<link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>

<!-- php로부터 데이터 받기 테스트 ?실패?
<script type="text/javascript">
	function getData(name) {
		alert('hi');
		var posting = $.post("test.php", {
			tester: name
		});
		
		posting.done(function(data) {
			alert(data);
		});
		
		posting.fail(function() {
			alert("failed");
		});
		
	}
	
	$(document.ready(function() {
		getData("김기담");
	});

</script>
	
-->

<!--데이터 인클루드 -->
<?php include ('depositTotal.php'); ?>



</head>

<body>
<div data-role="page" id="page">
  <div data-role="header" data-theme="a">
    <h1>머리글</h1>
  </div>
  <div data-role="content" style="font-size: 15px;">
    <div class="ui-grid-a" >

	

		<div class="ui-block-a"><a data-role="button" >김기담</a></div>
		<div class="ui-block-b">
		<?php
			include('depositTotal.php');
			echo($depositTotal[김기담]); 
		?>
		 <?php
			echo($var);
			?>
		
    
  		</div>
  		
  		<div class="ui-grid-a">
  			<form>
  			<input type='BUTTON' value='dd' onclick='getData("김기담")'>
			</form>
  		</div>
  		
	  </div>
  <div data-role="footer" data-theme="d">
    <h4>바닥글</h4>
  </div>
</div>
</body>
</html>