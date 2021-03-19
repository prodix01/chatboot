<?php

//URLに"actions"があったら
if(isset($_POST["actions"])){

  //actions内容が"リセット"だったら
  if($_POST["actions"] == "リセット"){

    //db接続
    $conn = mysqli_connect("localhost", "root", "rarkig18712","test_database");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

    //TABLEデータ全部削除
    $sql = "TRUNCATE TABLE insertUser";


    //error Check
    if ($conn->query($sql) === TRUE) {
        echo "チャットデータをリセットしました。";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

  }
}
?>