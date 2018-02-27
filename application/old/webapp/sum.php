<?php
	/* file for Calculating sum */
	
	include_once('data.php');

	$sum = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
	for ($i = 0; $i < 13; $i++) {
				
		foreach ($datas[0][$i][3] as $depoAmount) {
			
			$sum[$i] = $sum[$i] + $depoAmount;
			$sum[13] = $sum[13] + $depoAmount;
			
			
			
			
		}
		
		foreach ($datas[1][$i][4] as $expentAmount) {
			
			
			$sum[$i] = $sum[$i] - $expentAmount;
			$sum[13] = $sum[13] - $expentAmount;
			
		}
		/*
		print("    ");
		print_r($datas[1][$i][4]);
		foreach ($datas[1][$i][4] as $exAmount) {
			$sum[$i] = $sum[$i] - $exAmount;
			print("e"."$exAmount");
		}
		*/

	}




?>
	