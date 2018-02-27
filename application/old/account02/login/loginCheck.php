
<!-- File for login Checking.. -->
<?	
	 

		/* data file */

		include_once('../data.php');
		include_once('../sum.php');


		/* session */

		include("../session.php");

	

	$check_id = $_POST["user_id"];
	$check_pwd = $_POST["user_pwd"];
	
	

	/* ID가 전달되었는지 검사 */
	if (!isset($check_id)) { 
		header("Location: ../login/login.php#IDnull");
		
	} else if (!isset($check_pwd)) { 
		header("Location: ../login/login.php#PWDnull");
	
	/* ID와 PWD가 전달되었다면 */
	 } else { 
		/* login fail */
		 if(strcmp($loginInfo['$check_id'], $user_pwd) != 0) { 
		
			 header("Location: ../login/login.php#loginFail");
			/* End of Not loginFail page */
		 } else { 
			 $_SESSION["user_id"] = $check_id; 
			 $_SESSION["user_pwd"] = $check_pwd; 
			 
			 header("Location: ../data/main.php");

			
		
		 }
	}

?>