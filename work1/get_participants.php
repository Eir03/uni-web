<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "rootpassword";
$dbname = "conference";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM participants";
$result = $conn->query($sql);

$participants = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $participants[] = $row;
  }
}

echo json_encode($participants); // Возвращаем список в формате JSON
$conn->close();
?>
