    <?php
     $host = 'localhost';
     $user = 'jholee';
     $pw = 'dbqlqjs295';
     $dbName = 'jholee';
     $conn = new mysqli($host, $user, $pw, $dbName);
     
	if($conn->connect_error) {
		echo "Error";
	}

     $name=$_POST['name'];
     $password=md5($_POST['pwd']);
     
     
     $sql = "INSERT INTO members (name, pwd) 
	 			VALUES ('$name','$password')";
	
	 if (mysqli_query($conn, $sql)) {
    echo("New record created successfully");
} else {
    echo("Error: " . $sql . "<br>" . mysqli_error($conn));
}
     
?>