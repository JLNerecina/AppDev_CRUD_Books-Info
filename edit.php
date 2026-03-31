<?php
include 'config.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$id]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$book) {
    die("Book not found!");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $year = $_POST['year_published'] ?? '';
    $pages = $_POST['pages'] ?? '';

    if (empty($title) || empty($author) || empty($genre) || empty($year) || empty($pages)) {
        $error = "All fields are required!";
    } else {
        $image_name = $book['image']; // keep old image

        // If new image is uploaded
        if (!empty($_FILES['image']['name'])) {
            $target_dir = "uploads/";
            $image_name = time() . '_' . basename($_FILES['image']['name']);
            $target_file = $target_dir . $image_name;

            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

            if (in_array($ext, $allowed)) {
                move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
            }
        }

        $sql = "UPDATE books SET title=?, author=?, genre=?, year_published=?, pages=?, image=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $author, $genre, $year, $pages, $image_name, $id]);

        header("Location: index.php?success=Book updated successfully!");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #212529;
            color: white;
        }

        .card {
            background-color: #2b2f33;
            border: 2px solid #ffc107;
        }

        .form-label {
            color: white !important;
            font-weight: bold;
        }

        .card-header {
            background-color: #ffc107;
            color: #212529;
            font-weight: bold;
        }

        img {
            max-width: 180px;
            border: 3px solid #ffc107;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-header text-center py-3">
                <h3>✏️ Edit Book</h3>
            </div>
            <div class="card-body">
                <?php if (isset($error))
                    echo "<div class='alert alert-danger'>$error</div>"; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control"
                            value="<?= htmlspecialchars($book['title']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-control"
                            value="<?= htmlspecialchars($book['author']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genre</label>
                        <input type="text" name="genre" class="form-control"
                            value="<?= htmlspecialchars($book['genre']) ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Year Published</label>
                            <input type="number" name="year_published" class="form-control"
                                value="<?= $book['year_published'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pages</label>
                            <input type="number" name="pages" class="form-control" value="<?= $book['pages'] ?>"
                                required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Current Book Cover</label><br>
                        <img src="uploads/<?= htmlspecialchars($book['image']) ?>" alt="Current Cover">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Cover Image (optional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Update Book</button>
                    <a href="index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>