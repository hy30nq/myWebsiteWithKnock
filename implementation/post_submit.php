<?php
// post_submit.php
session_start();

// 사용자 로그인 확인
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login_page.php");
    exit;
}

include '../database/db.php'; // 데이터베이스 연결 정보 포함

$title = $_POST['title'];
$content = $_POST['content'];
$author = $_SESSION['username']; // 로그인한 사용자의 이름

$sql = "INSERT INTO guestbook (title, content, author) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $title, $content, $author);

if ($stmt->execute()) {
    echo "New record created successfully";
    header("Location: ../views/guestbook.php"); // 게시글 목록 페이지로 리다이렉트
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>
