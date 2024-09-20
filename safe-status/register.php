<!-- 登録ページのPHPコード (register.php) -->
<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO students (student_id, name, class, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $student_id, $name, $class, $password);
    
    if ($stmt->execute()) {
        $success = "登録に成功しました";
    } else {
        $error = "登録に失敗しました: " . $conn->error;
    }
}
?>

<!-- 登録ページのHTMLフォーム -->
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>登録</h2>
    <form method="post">
        <input type="text" name="student_id" placeholder="学生番号" required>
        <input type="text" name="name" placeholder="名前" required>
        <input type="text" name="class" placeholder="クラス" required>
        <input type="password" name="password" placeholder="パスワード" required>
        <button type="submit">登録</button>
    </form>
    <?php 
    if(isset($success)) echo "<p>$success</p>";
    if(isset($error)) echo "<p>$error</p>";
    ?>
</body>
</html>