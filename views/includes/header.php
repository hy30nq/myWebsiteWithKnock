<header>
  <nav>
    <div class="logo"><a href="/index.php">.hy30nq</a></div>
    <ul>
      <li><a href="/views/about.php">About</a></li>
      <li><a href="/views/file_manager.php">자료 공유</a></li>
      <li><a href="/views/write.php">글 작성</a></li>
      <li><a href="/views/guestbook.php">방명록</a></li>
      <?php
      if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        // 로그인이 되어 있지 않을 때
        echo '<li><a href="/views/register_page.php">회원가입</a></li>';
        echo '<li><a href="/views/login_page.php">로그인</a></li>';
      } else {
        // 로그인이 되어 있을 때
        echo '<li style="color: rgba(220, 20, 60, 0.8); font-weight: bolder;">' . $_SESSION['username'] . '</li>';
        echo '<li><a href="../implementation/logout.php">로그아웃</a></li>';
      }
      ?>
    </ul>
  </nav>
</header>