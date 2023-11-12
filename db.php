<?php

$host = 'localhost';
$db   = 'book_library';
$user = 'root';  // your DB user
$pass = 'Hadar2143';      // your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
