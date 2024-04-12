<?php
// db.php

$host = '127.0.0.1'; // 데이터베이스 호스트
$dbUsername = 'myweb'; // 데이터베이스 사용자 이름

// file_get_contents 함수를 사용하여 비밀번호 파일에서 비밀번호 읽기
$dbPassword = file_get_contents('../password/mysql_password.txt');

// 파일에서 읽은 비밀번호의 앞뒤 공백 제거(줄바꿈 문자 포함)
$dbPassword = trim($dbPassword);

$dbName = 'userDB'; // 데이터베이스 이름

// MySQLi 객체 방식을 이용한 데이터베이스 연결
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// 연결 오류 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
