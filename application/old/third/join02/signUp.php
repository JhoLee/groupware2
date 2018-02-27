<!DOCTYPE html>
<html>
		<head>
		
		<meta charset="UTF-8">
			
	    <link href="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css">
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
		
		</head>
		
		<body>
		
		<div data-role="page" id="login" data-theme="b">
		  <div data-role="header">
		    <h1>SignUp</h1>
	      </div>
		  <div data-role="content">
    	
	    	<form name="join" method="post" action="memberSave.php">
	    	
		    	<div data-role="fieldcontain">
		      	<label for="nameInput">Name</label>
		      	<input type="text" name="name" id="nameInput" value=""  />
	        	</div>
	        
		    	<div data-role="fieldcontain">
		    	  	<label for="pwdInput">Password</label>
		      		<input type="password" name="pwd" id="pwdInput" value=""  />
	        	</div>
	        	
	        	<!-- 삭제
		    	<div data-role="fieldcontain">
		      		<label for="passwordinput2">Confirm Password</label>
		      		<input type="password" name="pwd2" id="pwInput2" value=""  />
	        	</div>
	        	삭제 -->
	        	
		    	<input type="submit" value="Sign Up" />
		    	
		    
		  </form>
		    
	  </div>
		  <div data-role="footer" data-theme="a">
		    <h4>바닥글</h4>
	      </div>
	</div>
			
			
			
	</body>
</html>