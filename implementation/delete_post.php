<?php
// delete_post.php
session_start();
include '../database/db.php'; // 데이터베이스 연결 정보 포함

// 사용자 로그인 확인 및 작성자 확인 로직 필요
$id = $_GET['id'];

// SQL에서 직접 작성자를 검사하여 보안 강화
$sql = "DELETE FROM guestbook WHERE id = ? AND author = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $_SESSION['username']);

if ($stmt->execute()) {
    echo "Record deleted successfully";
    header("Location: ../views/guestbook.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
