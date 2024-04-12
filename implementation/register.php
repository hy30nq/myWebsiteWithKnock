<?php
include '../database/db.php'; // 데이터베이스 연결 정보 포함

// POST 데이터 받기
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // 비밀번호 해싱
$email = $_POST['email'];

// 동일한 사용자명 또는 이메일이 있는지 검사
$checkUser = "SELECT * FROM users WHERE username = ? OR email = ?";
$stmt = $conn->prepare($checkUser);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 동일한 사용자명 또는 이메일을 가진 사용자가 이미 있을 경우
    echo "<script>alert('An account with the same username or email already exists.'); location.href=\"../views/register_page.php\"</script>";
} else {
    // 데이터베이스에 사용자 정보 저장
    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        // 성공적으로 등록되면, 사용자를 로그인 페이지로 리다이렉트
        header("Location: ../views/login_page.php");
        exit();
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
