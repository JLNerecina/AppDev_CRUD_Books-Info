<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $year = $_POST['year_published'] ?? '';
    $pages = $_POST['pages'] ?? '';

    if (empty($title) || empty($author) || empty($genre) || empty($year) || empty($pages) || empty($_FILES['image']['name'])) {
        $error = "All fields are required, including the book cover!";
    } else {
        $target_dir = "uploads/";
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed) && $_FILES['image']['size'] < 5000000) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $sql = "INSERT INTO books (title, author, genre, year_published, pages, image) 
                        VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$title, $author, $genre, $year, $pages, $image_name]);

                header("Location: index.php?success=Book added successfully!");
                exit;
            } else {
                $error = "Failed to upload image.";
            }
        } else {
            $error = "Invalid image (only JPG, PNG, GIF allowed & max 5MB).";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add New Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #212529;
            color: white;
        }

        .card {
            background-color: #2b2f33;
            border: 2px solid #0d6efd;
        }

        .form-label {
            color: white !important;
            font-weight: bold;
        }

        .card-header {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-header text-center py-3">
                <h3>📘 Add New Book</h3>
            </div>
            <div class="card-body">
                <?php if (isset($error))
                    echo "<div class='alert alert-danger'>$error</div>"; ?>

                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Author</label>
                        <input type="text" name="author" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genre</label>
                        <input type="text" name="genre" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Year Published</label>
                            <input type="number" name="year_published" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pages</label>
                            <input type="number" name="pages" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Book Cover Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Save Book</button>
                    <a href="index.php" class="btn btn-secondary w-100 mt-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>