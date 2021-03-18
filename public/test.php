<?php
$servername = "localhost";
$username = "root";
$password = "rarkig18712";
$dbname = "test_database";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql isert
$sql = "INSERT INTO ChatsLog (user, message)
VALUES ('user','hello')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>