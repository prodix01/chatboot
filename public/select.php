<?php


//db연결 본인의 db 정보를 넣어준다!
$conn = mysqli_connect("localhost", "root", "rarkig18712","test_database");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


//users테이블 조회 프로시져를 만든다.
$result = mysqli_query($conn,"SELECT * FROM insertUser");


//echo "<table border='1'> <tr> <th>bot</th> <th>user</th></tr>";
$n = 1;

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


echo "</table>";
mysqli_close($conn);

?>
