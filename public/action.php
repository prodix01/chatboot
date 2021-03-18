<?php

//url에 action이라는 값이 존재하면


//db연결
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

//url에 action이라는 값이 "추가" 라면
//ajax로 넘긴 data를 받아준다.
$first_name=mysqli_real_escape_string($conn,$_POST["firstName"]);
$last_name=mysqli_real_escape_string($conn,$_POST["lastName"]);



//참고-mysqli_real_escape_string
//:MySQL로 질의를 전송하기 전에 안전하게 데이터를 만들기 위해 사용
//특수 문자열을 이스케이프하여 mysql_query() 수행시 안전하게 질의할 수 있도록 한다.

//insert
$sql = "INSERT INTO insertUser (firstname, lastname)
VALUES ('$first_name','$last_name')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>
