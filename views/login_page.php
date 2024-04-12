<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="icon" href="/public/images/favicon.ico" />
    <link rel="stylesheet" href="/public/styles/styles.css" />
    <link rel="stylesheet" href="/public/styles/login_page_style.css" />
</head>
<body>
    <?php include './includes/header.php'; ?>
    <main>
        <h2>Login</h2>
        <form action="../implementation/login.php" method="post">
            <input type="text" name="username" required placeholder="Username"><br>
            <input type="password" name="password" required placeholder="Password"><br>
            <input type="submit" value="Login">
        </form>
    </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>
