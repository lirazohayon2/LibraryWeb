<?php
// Include the database connection
include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags for proper character set and responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title of the page -->
    <title>Liraz's Book Library</title>

    <!-- Link to the external stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Main heading -->
<h1>Liraz Ohayon's books</h1>

<!-- Form to add a new book to the library -->
<form class="book-form" action="add.php" method="post">
    Title: &nbsp&nbsp <input type="text" name="title" required> </br>
    Author: <input type="text" name="author" required> </br>
    Genre: <input type="text" name="genre"> </br>
    <input type="submit" value="Add Book">
</form>

<!-- Add Search Functionality -->
<form action="index.php" method="get">
     Search by:
     <select name="searchType">
         <option value="title">Title</option>
         <option value="author">Author</option>
         <option value="genre">Genre</option>
     </select>
     <input type="text" name="query" placeholder="Enter search term..." required>
     <input type="submit" value="Search">
</form>

<!-- Reset Search Link -->
<a href="index.php" class="reset-search">Reset Search and View All</a>

<!-- Table to display the list of books -->
<table>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Action</th>
    </tr>

    <?php
         $query = isset($_GET['query']) ? trim($_GET['query']) : '';
         $searchType = isset($_GET['searchType']) ? $_GET['searchType'] : '';
    
         if ($query) {
             $sql = "SELECT * FROM books WHERE $searchType LIKE :query";
             $stmt = $pdo->prepare($sql);
             $stmt->execute(['query' => "%$query%"]);
         } else {
             $stmt = $pdo->query("SELECT * FROM books");
         }

        // Loop through each book and display in the table
        while ($row = $stmt->fetch()) {
            echo "<tr>";
            // Display the title, author, and genre of each book
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['author']) . "</td>";
            echo "<td>" . htmlspecialchars($row['genre']) . "</td>";

            // Provide options to edit or delete the book
            echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
            echo "</tr>";
        }
    ?>

</table>

<footer class="my-web">
    This site was build by &copy;Liraz Ohayon
</footer>

</body>
</html>
