<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    $stmt = $pdo->prepare("INSERT INTO books (title, author, genre) VALUES (?, ?, ?)");
    $stmt->execute([$title, $author, $genre]);

    header("Location: index.php");
}

?>
