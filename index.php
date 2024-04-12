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