<?php
session_start(); // 세션 시작

include '../database/db.php'; // 데이터베이스 연결 정보 포함

$username = $_POST['username'];
$password = $_POST['password'];

// 사용자명으로 사용자 검색
$sql = "SELECT id, username, password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // 비밀번호 일치, 로그인 성공
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $row['id'];

        // 인덱스 페이지나 사용자 대시보드로 리다이렉트
        header("Location: ../index.php");
    } else {
        // 비밀번호 불일치
        echo "<script>
            if (window.confirm('사용자 이름 또는 비밀번호가 올바르지 않습니다. - 회원 가입을 하시겠습니까?')) {
                window.location.href = '../views/register_page.php';
            } else {
                window.location.href = '../views/login_page.php';
            }
        </script>";
    }
} else {
    // 사용자명이 존재하지 않음
    echo "<script>
    if (window.confirm('사용자 이름 또는 비밀번호가 올바르지 않습니다. - 회원 가입을 하시겠습니까?')) {
        window.location.href = '../views/register_page.php';
    } else {
        window.location.href = '../views/login_page.php';
    }
    </script>"; 
}

$conn->close();
