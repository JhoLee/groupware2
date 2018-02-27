<?php
	
	include('accountConnect.php');

function getData($name) {
	
	$sql = $connect->query("
		    SELECT date,
    
       usagePlace AS 사용처,
    
       SUM(CASE name WHEN '$name' THEN ammount
            ELSE NULL 
			END) as 김기담,
			
		SUM(amount) as 합계
		From expenditure;
			
			");
	if($row = $sql->fetch_object()) {
		echo $row->김기담;
	}
	
}
	

?>	