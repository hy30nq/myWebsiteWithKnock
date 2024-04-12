<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<script>alert('You must be logged in to edit a post.'); window.location.href = 'login_page.php';</script>";
    exit;
}

include '../database/db.php';

$id = $_GET['id'];

// Fetch post data for editing
$sql = "SELECT id, title, content FROM guestbook WHERE id = ? AND author = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/public/images/favicon.ico" />
    <link rel="stylesheet" href="/public/styles/styles.css" />
    <link rel="stylesheet" href="/public/styles/write_edit_style.css" />
    <title>Edit Post</title>
</head>

<body>
    <?php include '../views/includes/header.php'; ?>
    <main>
        <h2>Edit Post</h2>
        <form action="../implementation/update_post.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            Title: <input type="text" name="title" value="<?php echo htmlspecialchars($row["title"]); ?>" required><br>
            Content:<br>
            <textarea name="content" rows="5" cols="40" required><?php echo htmlspecialchars($row["content"]); ?></textarea><br>
            <input type="submit" value="Update">
        </form>
    </main>
    <?php include '../views/includes/footer.php'; ?>
</body>

</html>
<?php
} else {
    echo "No such post found or you do not have permission to edit this post.";
}
$conn->close();
?>
