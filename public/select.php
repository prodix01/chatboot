<?php


//db接続
$conn = mysqli_connect("localhost", "root", "rarkig18712","test_database");

// 接続確認
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

//チャットデータがあるTABLEを選択
$result = mysqli_query($conn,"SELECT * FROM insertUser");

$n = 1;
//チャットデータをチャットフォームに合わせて出力。
while($row = mysqli_fetch_array($result)){
echo "<div class='bot-inbox inbox'>";
echo "<div class='icon'>";
echo "<i class='fas fa-robot aria-hidden='true'></i>";
echo "</div>";
echo "<div class='msg-header'>";
echo "<p>" . $row["firstname"] . "</p>";
echo "</div>";
echo "</div>";

echo "<div class='user-inbox inbox'>";
echo "<div class='msg-header'>";
echo "<p>" . $row["lastname"] . "</p>";
echo "</div>";
echo "</div>";

$n++;
}

//連結終了
mysqli_close($conn);

?>
