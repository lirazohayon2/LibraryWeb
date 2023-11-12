<?php

include 'db.php';

// Fetch the existing book details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$id]);
    $book = $stmt->fetch();
}

// Update the book details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];

    $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, genre = ? WHERE id = ?");
    $stmt->execute([$title, $author, $genre, $id]);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Edit Book</h1>

<form action="edit.php" method="post">
    <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
    Title: <input type="text" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
    Author: <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
    Genre: <input type="text" name="genre" value="<?php echo htmlspecialchars($book['genre']); ?>">
    <input type="submit" value="Update Book">
</form>

<a href="index.php">Back to list</a>

</body>
</html>
