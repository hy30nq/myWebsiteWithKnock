<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('You must be logged in to see a post.'); window.location.href = 'login_page.php';</script>";
    exit;
}
include '../database/db.php';
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Guestbook</title>
    <link rel="icon" href="/public/images/favicon.ico" />
    <link rel="stylesheet" href="/public/styles/styles.css" />
    <link rel="stylesheet" href="/public/styles/guestbook_style.css" />
</head>

<body>
    <?php include '../views/includes/header.php'; ?>

    <main>
        <?php

        $search = isset($_GET['search']) ? $_GET['search'] : '';

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        echo '<section id="search_guestbook">';
        echo '  <form action="" method="get" >';
        echo '      <input type="text" name="search" placeholder="Search by title..." value="' . htmlspecialchars($search) . '">';
        echo '      <input type="submit" value="Search">';
        echo '  </form>';
        echo '</section>';

        if ($search) {
            $sql = "SELECT COUNT(*) as total FROM guestbook WHERE title LIKE ?";
            $stmt = $conn->prepare($sql);
            $searchTerm = '%' . $search . '%';
            $stmt->bind_param("s", $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
            $total = $result->fetch_assoc()['total'];
        } else {
            $sql = "SELECT COUNT(*) as total FROM guestbook";
            $total = $conn->query($sql)->fetch_assoc()['total'];
        }
        $pages = ceil($total / $perPage);

        if ($search) {
            $sql = "SELECT id, title, content, author, post_date FROM guestbook WHERE title LIKE ? ORDER BY post_date DESC LIMIT $perPage OFFSET $offset";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $searchTerm);
        } else {
            $sql = "SELECT id, title, content, author, post_date FROM guestbook ORDER BY post_date DESC LIMIT $perPage OFFSET $offset";
            $stmt = $conn->prepare($sql);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo '<section id="guestbook_entries">';
            while ($row = $result->fetch_assoc()) {
                echo '<article>';
                echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
                echo "<p class='main_text'>" . htmlspecialchars($row["content"]) . "</p>";
                echo "<p>Posted by <span id=\"author_in_article\"> " . htmlspecialchars($row["author"]) . "</span> on </br>" . $row["post_date"] . "</p>";
                if (isset($_SESSION['username']) && $_SESSION['username'] == $row["author"]) {
                    echo "<a href='./edit_post.php?id=" . $row["id"] . "' class=\"btn\">Edit</a> ";
                    echo "<a onclick=\"return  confirm('do you want to delete Y/N')\" href='../implementation/delete_post.php?id=" . $row["id"] . "' class=\"btn\">Delete </a>";
                }
                echo '</article>';
            }
            echo '</section>';
        } else {
            echo "<p id='nofound'>No results found.</p>";
            echo "<a href='./guestbook.php' class=\"btn\">돌아가기</a>";
        }


        echo '<section id="pagination">';
        for ($i = 1; $i <= $pages; $i++) {
            echo "<a href='?page=$i&search=" . urlencode($search) . "'>$i</a> ";
        }
        echo '</section>';

        $conn->close();
        ?>
    </main>
    <?php include '../views/includes/footer.php'; ?>
</body>

</html>