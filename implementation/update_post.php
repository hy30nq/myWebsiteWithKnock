<?php
// update_post.php
session_start();
include '../database/db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

// 업데이트 쿼리 실행
$sql = "UPDATE guestbook SET title = ?, content = ? WHERE id = ? AND author = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $title, $content, $id, $_SESSION['username']);

if ($stmt->execute()) {
    echo "Post updated successfully";
    header("Location: ../views/guestbook.php"); // 게시글 목록 페이지로 리다이렉트
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
