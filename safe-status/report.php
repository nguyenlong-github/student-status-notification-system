<!-- 報告ページのPHPコード (report.php) -->
<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $student_id = $_SESSION['student_id'];
    
    $sql = "UPDATE students SET status = ? WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $status, $student_id);
    
    if ($stmt->execute()) {
        $success = "状況の更新に成功しました";
    } else {
        $error = "更新に失敗しました: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>状況報告</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>状況報告</h2>
    <form method="post">
        <button type="submit" name="status" value="安全">安全</button>
        <button type="submit" name="status" value="危険">危険</button>
    </form>
    <?php 
    if(isset($success)) echo "<p>$success</p>";
    if(isset($error)) echo "<p>$error</p>";
    ?>
    <a href="home.php">ホームページに戻る</a>
</body>
</html>