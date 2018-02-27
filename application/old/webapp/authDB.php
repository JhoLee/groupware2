<?php

$server = 'localhost';
$username = 'jho';
$password = '@admin295';
$database = 'auth';

try {
	$conn = new PDO("mysql: host=$server; dbname=$database;", $username, $password);
} catch(PDOException $e) {
	die("Connection failed: ". $e->getMessage());
}

