<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  echo "<script>alert('You must be logged in to edit a post.'); window.location.href = 'login_page.php';</script>";
  exit;
}
include '../database/db.php'; // 필요한 경우 DB 연결 파일 포함

$uploadDir = '../uploaded_files/'; // 파일 업로드 디렉터리
$perPage = 10; // 페이지 당 파일 수

// 파일 업로드 처리 부분 수정
if (isset($_FILES['fileToUpload'])) {
  $uploadFile = $uploadDir . basename($_FILES['fileToUpload']['name']);
  if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadFile)) {
    // 파일 정보를 데이터베이스에 기록
    $stmt = $conn->prepare("INSERT INTO uploaded_files (filename, uploader) VALUES (?, ?)");
    $stmt->bind_param("ss", $_FILES['fileToUpload']['name'], $_SESSION['username']);
    $stmt->execute();

    header("Location: file_manager.php");
    exit;
  } else {
    echo "<script>alert('File upload failed.');</script>";
  }
}


// 파일 삭제 처리 부분 수정
if (isset($_GET['delete'])) {
  $filename = basename($_GET['delete']);
  $fileToDelete = $uploadDir . $filename;

  // 파일 업로더 확인
  $stmt = $conn->prepare("SELECT id FROM uploaded_files WHERE filename = ? AND uploader = ?");
  $stmt->bind_param("ss", $filename, $_SESSION['username']);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0 && file_exists($fileToDelete)) {
    // 파일 삭제
    unlink($fileToDelete);
    // 데이터베이스에서 파일 정보 삭제
    $stmt = $conn->prepare("DELETE FROM uploaded_files WHERE filename = ? AND uploader = ?");
    $stmt->bind_param("ss", $filename, $_SESSION['username']);
    $stmt->execute();

    header("Location: file_manager.php");
    exit;
  } else {
    echo "<script>alert(\"File does not exist or you do not have permission to delete this file.\")</script>";
  }
}


// 파일 목록 및 검색 기능
$allFiles = array_slice(scandir($uploadDir), 2); // '.'과 '..' 제외
$search = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($search)) {
  $allFiles = array_filter($allFiles, function ($file) use ($search) {
    return stripos($file, $search) !== false;
  });
}

// 검색 결과에 따른 페이지네이션 재계산
$totalFiles = count($allFiles);
$totalPages = ceil($totalFiles / $perPage);

// 페이지네이션 변수 설정 및 현재 페이지의 파일 목록 가져오기
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;
$filesToShow = array_slice($allFiles, $offset, $perPage);
?>
<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="/public/images/favicon.ico" />
  <link rel="stylesheet" href="/public/styles/styles.css" />
  <link rel="stylesheet" href="/public/styles/file_manager_style.css" />
  <title>File Upload and Management</title>
</head>

<body>
  <?php include '../views/includes/header.php'; ?>
  <main>
    <section id="upload_file">
      <h2>Upload a File</h2>
      <form action="file_manager.php" method="post" enctype="multipart/form-data">
        Select file to upload
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload File" name="submit">
      </form>
    </section>

    <section id="search_file">
      <h2>Search a File</h2>
      <form action="file_manager.php" method="get">
        <input type="text" name="search" placeholder="Search files..." value="<?php echo htmlspecialchars($search); ?>">
        <input type="submit" value="Search">
      </form>
    </section>

    <section id="upload_file_list">
      <h2>Uploaded Files</h2>
      <ul>
        <?php foreach ($filesToShow as $file) : ?>
          <li>
            <?php echo htmlspecialchars($file); ?> 
            </br></br> 
            <a href="<?php echo $uploadDir . htmlspecialchars($file); ?>" download>Download</a> 
            <a href="?delete=<?php echo urlencode($file); ?>&search=<?php echo urlencode($search); ?>">Delete</a>
        </li>
        <?php endforeach; ?>
        <?php 
        if (!$file) {
          echo "<p>검색 결과를 찾을 수 없습니다.</p>";
        }
        ?>
      </ul>
    </section>

    <section id="file_page">
      <div>
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
          <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
      </div>
    </section>
  </main>
  <?php include '../views/includes/footer.php'; ?>
</body>

</html>