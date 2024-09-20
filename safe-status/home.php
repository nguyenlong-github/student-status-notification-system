<!-- -- ホームページのPHPコード (home.php) -->
<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>学生リストと状況</h2>
    <table>
        <tr>
            <th>学生番号</th>
            <th>名前</th>
            <th>クラス</th>
            <th>状況</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['student_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['class']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="report.php">状況を報告</a>
    <a href="logout.php">ログアウト</a>
</body>
</html>