<?php
session_start(); // 현재 세션을 시작하거나 재개

// 모든 세션 변수를 제거
$_SESSION = array();

// 세션 쿠키를 삭제
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 세션을 파괴하여 로그아웃
session_destroy();

// 로그인 페이지나 홈페이지로 리다이렉트
header("Location: ../index.php");
exit;
?>
