<?php
include 'config.php';
$stmt = $pdo->query("SELECT * FROM books ORDER BY created_at DESC");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Books Information - CRUD PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-img {
            width: 80px;
            height: 110px;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
</head>

<body class="bg-dark text-white">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-success">📚 Books Information Lists</h1>
            <a href="create.php" class="btn btn-success btn-lg">+ Add New Book</a>
        </div>

        <div class="card bg-dark border-success">
            <div class="card-body">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Year</th>
                            <th>Pages</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><img src="uploads/<?= htmlspecialchars($book['image']) ?>" class="book-img" alt="cover">
                                </td>
                                <td>
                                    <?= htmlspecialchars($book['title']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($book['author']) ?>
                                </td>
                                <td>
                                    <?= htmlspecialchars($book['genre']) ?>
                                </td>
                                <td>
                                    <?= $book['year_published'] ?>
                                </td>
                                <td>
                                    <?= $book['pages'] ?>
                                </td>
                                <td>
                                    <a href="edit.php?id=<?= $book['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete.php?id=<?= $book['id'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this book?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>