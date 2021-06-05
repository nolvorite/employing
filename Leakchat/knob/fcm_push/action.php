<?php
	if(isset($_POST['token'])) {


	
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "leakchat_leakchat";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO gr_users (`token_id`)
VALUES ('John')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

        }
/*
	if(isset($_POST['token'])) {
		require 'DbConnect.php';
		$db = new DbConnect;
		$conn = $db->connect();
		//$cdate = date('Y-m-d');
		$stmt = $conn->prepare('INSERT INTO gr_users VALUES(null, :token_id)');
		$stmt->bindParam(':token_id', $_POST['token']);
		//$stmt->bindParam(':cdate', $cdate);
		if($stmt->execute()) {
			echo 'Token Saved..';
		} else {
			echo 'Failed to saved token..';
		}
	}
*/
 ?>