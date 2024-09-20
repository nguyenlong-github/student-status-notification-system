<!-- ログインページのPHPコード (login.php) -->
<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['student_id'] = $student_id;
            header("Location: home.php");
        } else {
            $error = "パスワードが間違っています";
        }
    } else {
        $error = "アカウントが見つかりません";
    }
}
?>
<!-- ログインページのHTMLフォーム -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>ログイン</h2>
    <form method="post">
        <input type="text" name="student_id" placeholder="学生番号" required>
        <input type="password" name="password" placeholder="パスワード" required>
        <button type="submit">ログイン</button>
    </form>
    <?php if(isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>