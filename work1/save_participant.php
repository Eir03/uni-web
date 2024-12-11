<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conference";

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Проверяем, был ли отправлен запрос методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Получаем данные из формы и экранируем их
  $fullName = $conn->real_escape_string($_POST['fullName']);
  $phone = $conn->real_escape_string($_POST['phone']);
  $email = $conn->real_escape_string($_POST['email']);
  $section = $conn->real_escape_string($_POST['section']);
  $birthDate = isset($_POST['birthDate']) ? $conn->real_escape_string($_POST['birthDate']) : null;
  $hasReport = isset($_POST['hasReport']) ? 1 : 0;
  $reportTopic = isset($_POST['reportTopic']) ? $conn->real_escape_string($_POST['reportTopic']) : null;

  // Подготовка SQL-запроса для вставки данных в таблицу
  $sql = "INSERT INTO participants (fullName, phone, email, section, birthDate, hasReport, reportTopic) 
          VALUES ('$fullName', '$phone', '$email', '$section', '$birthDate', '$hasReport', '$reportTopic')";

  // Выполнение запроса
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Участник успешно зарегистрирован!'); window.location.href='index.php';</script>";
  } else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
  }
}

// Закрываем подключение
$conn->close();
?>
