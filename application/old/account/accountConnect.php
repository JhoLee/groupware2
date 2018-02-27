<?php

	$mysql_host = "localhost";

	$mysql_user = "jho";

	$mysql_pw = "@admin295";

	$mysql_database = "account";



	$connect = mysqli_connect($mysql_host, $mysql_user, $mysql_pw, $mysql_database);

	if(!$connect) die('Not Connected : ' . mysqli_error());



?>
