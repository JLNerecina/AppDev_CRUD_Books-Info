<?php
//For infinityfree hosting
$host = 'sql213.infinityfree.com';
$dbname = 'if0_41547962_book_info';
$username = 'if0_41547962';
$password = 'Nrur129l1I';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

//For localhosting
/*$host = 'localhost';
$dbname = 'books_info';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}*/
?>
