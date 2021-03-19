<?php

//db接続
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

//ajaxからPOSTしたデータをもらう
$first_name=mysqli_real_escape_string($conn,$_POST["firstName"]);
$last_name=mysqli_real_escape_string($conn,$_POST["lastName"]);



//mysqli_real_escape_string
//:MySQLに質疑を転送する前に安全にデータを作るために使う。
//特殊な文字列をEscapeし　mysql_query()　を実行する時、安全に質疑できるようにする。

//AjaxからPOSTしたデータをDBに入力する。
$sql = "INSERT INTO insertUser (firstname, lastname)
VALUES ('$first_name','$last_name')";

//error check
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>
