<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('You must be logged in to post a message.'); window.location.href = 'login_page.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/public/images/favicon.ico" />
    <link rel="stylesheet" href="/public/styles/styles.css" />
    <link rel="stylesheet" href="/public/styles/write_edit_style.css" />
    <title>Write a Post</title>
</head>

<body>
    <?php include '../views/includes/header.php'; ?>
    <main>
        <h2>Write a Post</h2>
        <form action="../implementation/post_submit.php" method="post">
            <input type="text" name="title" required placeholder="title"><br>
            <br>
            <textarea name="content" rows="5" cols="40" required placeholder="content"></textarea><br>
            <input type="submit" value="Submit">
        </form>
    </main>
    <?php include '../views/includes/footer.php'; ?>

</body>

</html>