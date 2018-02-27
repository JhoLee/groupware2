<?php
	include('../mysql/accountConnect.php');

	$sql = "
		SELECT
			SUM(CASE WHEN name = '김기담' THEN amount ELSE 0 END) As 김기담, 
			SUM(CASE WHEN name = '김제린' THEN amount ELSE 0 END) As 김제린,
			SUM(CASE WHEN name = '김헵시바' THEN amount ELSE 0 END) As 김헵시바, 
			SUM(CASE WHEN name = '박재현' THEN amount ELSE 0 END) As 박재현, 
			SUM(CASE WHEN name = '양지원' THEN amount ELSE 0 END) As 양지원, 
			SUM(CASE WHEn name = '이건' THEN amount ELSE 0 END) As 이건,
			SUM(CASE WHEN name = '이주호' THEN amount ELSE 0 END) As 이주호, 
			SUM(CASE WHEN name = '전민석' THEN amount ELSE 0 END) As 전민석, 
			SUM(CASE WHEN name = '정원영' THEN amount ELSE 0 END) As 정원영, 
			SUM(CASE WHEN name = '정혜경' THEN amount ELSE 0 END) As 정혜경, 
			SUM(CASE WHEN name = '한종현' THEN amount ELSE 0 END) As 한종현, 
			SUM(CASE WHEN name = '허채원' THEN amount ELSE 0 END) As 허채원, 
			SUM(amount) As Total 
		FROM deposit
			";


		
	$depositResult = mysqli_query($connect, $sql);
	echo(mysqli_fetch_array($depositREsult));
	$depositTotal = mysqli_fetch_array($depositResult);
	
	echo ('가 '.'나 '.$depositTotal[0]);

	while($depositTotal) {
		echo('1');
		echo ($depositTotal[$i]);
	}

	$depositTotal = mysqli_fetch_array($depositResult);
	
	echo ('다 '.'라 '.$depositTotal["김기담"].'마');

	$var = 1;

	echo('ddd');



	
?>