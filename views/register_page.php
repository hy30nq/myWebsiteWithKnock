<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="/public/images/favicon.ico" />
  <link rel="stylesheet" href="/public/styles/styles.css" />
  <link rel="stylesheet" href="/public/styles/register_page_style.css" />
  <title>Register</title>
  <script>
    // 폼 제출 전 비밀번호 확인
    function validatePassword() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm_password").value;

      if (password != confirmPassword) {
        alert("Passwords do not match.");
        return false; // 비밀번호가 일치하지 않으면 폼 제출을 방지
      }
      return true; // 비밀번호가 일치하면 폼 제출 계속
    }
  </script>
</head>

<body>
  <?php include './includes/header.php'; ?>

  <main>
    <h2>회원가입</h2>
    <form action="../implementation/register.php" method="post" onsubmit="return validatePassword();">
      Username: <input type="text" name="username" required><br>
      Password: <input type="password" name="password" id="password" required><br>
      Confirm Password: <input type="password" name="confirm_password" id="confirm_password" required><br>
      Email: <input type="email" name="email" required><br>
      <input type="submit" value="Register">
    </form>
    <!-- <p>보안 상의 이유로 잠정 중단합니다.</p> -->
  </main>
  <?php include './includes/footer.php'; ?>

</body>

</html>
