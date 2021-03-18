<?php

if(isset($_POST["actions"])){

if($_POST["actions"] == "リセット"){

//db연결 본인의 db 정보를 넣어준다!
$conn = mysqli_connect("localhost", "root", "rarkig18712","test_database");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "TRUNCATE TABLE insertUser";



  if ($conn->query($sql) === TRUE) {
    echo "チャットデータをリセットしました。";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

}
}
?>