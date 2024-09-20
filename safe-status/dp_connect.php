<!-- データベース接続ファイル (db_connect.php) -->
<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "student_safety";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}
?>