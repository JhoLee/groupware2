<?php

// include database connection code
include_once('accountConnect.php');

// create an output array
$output = array();

// if the MySQL query returned any results
if (mysql_affected_rows() > 0) {

	// iterate through the results of query
	while ($row = mysql_fetch_assoc($query)) {

		// add the results of query to the ouput variable
		$output[] = $row;
	}

	// send output to the browser encoded in the JSON format
	echo json_encode(array('status' => 'success', 'items' => $output));
} else {

	// if no records were found in the database then output an error message encoded in the JSON format
	echo json_encode(array('status' => 'error', 'items' => $output));
}

?>
