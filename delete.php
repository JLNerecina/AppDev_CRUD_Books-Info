<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get image name before deleting record
    $stmt = $pdo->prepare("SELECT image FROM books WHERE id = ?");
    $stmt->execute([$id]);
    $book = $stmt->fetch();

    if ($book) {
        // Delete record
        $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
        $stmt->execute([$id]);

        // Delete image file
        if (file_exists("uploads/" . $book['image'])) {
            unlink("uploads/" . $book['image']);
        }
    }
}

header("Location: index.php?success=Book deleted successfully!");
exit;
?>