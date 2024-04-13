<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hyeon-Gyu, Lee's website</title>
  <link rel="icon" href="/public/images/favicon.ico" />

  <link rel="stylesheet" href="/public/styles/styles.css" />
  <link rel="stylesheet" href="/public/styles/index_style.css" />

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 화면의 너비를 확인하여 모바일 디바이스인지 판단하는 함수
        function checkIfMobile() {
            const maxWidth = 800; // 모바일로 간주되는 최대 화면 너비
            if (window.innerWidth <= maxWidth) {
                alert('모바일 기기로 접속하셨습니다. 해당 사이트는 컴퓨터에 최적화 되어 있습니다. 컴퓨터 환경에서 접속하는 것을 추천합니다. 모바일은 화면 인터페이스가 제대로 보이지 않을 수 있습니다.');
            }
        }

        // 함수 실행
        checkIfMobile();
    });
</script>


</head>

<body>
  <?php include './views/includes/header.php'; ?>
  <div class="container">
    <main>
      <section id="home" class="profile">
        <img src="/public/images/profile.gif" alt="Hyeon-Gyu, Lee" />
        <h1>Hello I'm</h1>
        <h1>Hyeon-Gyu, Lee</h1>
        <p>
          </br></br>
          다른 사람은 과거를 배우고 있을 때 우리는 미래를 배우고 있다.
          </br> </br>
          보안 공부하고 있습니다!
        </p>
        <a href="https://hyeonql.tistory.com/" class="btn" target="_blank">More About Me</a>
      </section>
    </main>
  </div>
  <?php include './views/includes/footer.php'; ?>
</body>

</html>
