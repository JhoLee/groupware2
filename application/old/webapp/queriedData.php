<?php

	/*
	 * This file recives querieddatas of both 'deposit', 'expenditure', 
	 * and save it to php variables.
	 *  17/10/14
	 */
	
	/* MySQL Connect... */
	$mysql_host = "localhost";

	$mysql_user = "jho";

	$mysql_pw = "@admin295";

	$mysql_database = "account";



	$connect = mysqli_connect($mysql_host, $mysql_user, $mysql_pw, $mysql_database);

	if(!$connect) die('Not Connected : ' . mysqli_error());
	$connect->query("set names utf8;");
	/* */

/* deposit */
	/* Query Datas from DB... */
	$sql = "
			SELECT date,

			   usagePlace AS 사용처,
			   
			   SUM(CASE name WHEN '기타' THEN amount
			   		ELSE NULL
					END) as 기타,

			   SUM(CASE name WHEN '김기담' THEN amount
					ELSE NULL 
					END) as 김기담,

			   SUM(CASE name WHEN '김제린' THEN amount
					ELSE NULL 
					END) as 김제린,

			   SUM(CASE name WHEN '김헵시바' THEN amount
					ELSE NULL 
					END) as 김헵시바,

			   SUM(CASE name WHEN '박재현' THEN amount
					ELSE NULL 
					END) as 박재현,

			   SUM(CASE name WHEN '양지원' THEN amount
					ELSE NULL 
					END) as 양지원,

			   SUM(CASE name WHEN '이건' THEN amount
					ELSE NULL 
					END) as 이건,

			   SUM(CASE name WHEN '이주호' THEN amount
					ELSE NULL 
					END) as 이주호,

			   SUM(CASE name WHEN '전민석' THEN amount
					ELSE NULL 
					END) as 전민석,

			   SUM(CASE name WHEN '정원영' THEN amount
					ELSE NULL 
					END) as 정원영,

			   SUM(CASE name WHEN '정혜경' THEN amount
					ELSE NULL 
					END) as 정혜경,

			   SUM(CASE name WHEN '한종현' THEN amount
					ELSE NULL 
					END) as 한종현,

			   SUM(CASE name WHEN '허채원' THEN amount
					ELSE NULL 
					END) as 허채원,

				SUM(amount) AS 합계
			FROM expenditure
			GROUP BY date, usagePlace
			ORDER BY date 
		";

	/* Saving datas into php variables */
	$result = mysqli_query($connect, $sql);

	
	/* 
	 * 				quriedDatas =	[0] deposit[]	[1] expenditure[]
	 * deposit[], expenditure[] =	[0] 기타[]	[1] 김기담[] ... [12] 허채원[]
	 * 					name[] =	[0] date[]	[1] usage[]	[2] amount[]	
	 */
	$queriedDatas = array(array(/* deposit */),
				
						array(
		/* expenditure */
				/* 기타 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 김기담 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 김제린 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 김헵시바 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 박재현 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 양지원 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 이건 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 이주호 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 전민석 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 정원영 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 정혜경 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 한종현 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
				/* 허채원 */	array(
								array(/* date */), array(/* usage */), array(/* amount */ ), array(/* sum */)),
							)
					);
				
							
	while ($row = mysqli_fetch_row($result)) {
		
		
		for ($i = 0; $i < 13; $i++) {
			
			if($row[$i + 2]) {		
				/* if there is an amount value */
				
				array_push($queriedDatas[1][$i][0], $row[0]);
				array_push($queriedDatas[1][$i][1], $row[1]);
				array_push($queriedDatas[1][$i][2], $row[$i + 2]);
				array_push($queriedDatas[1][$i][3], $row[15]);
				
				
				
			}
			
		}
		
	}

	






?>