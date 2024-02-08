<?php
// Database connection
require_once "includes/db.inc.php";

// Get book ID from URL parameter
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
} else {
    echo "Book ID not provided";
    exit;
}

// Query to retrieve book details based on ID
$sql = "SELECT * FROM books WHERE id = $book_id";
$result = $conn->query($sql);

// Check if book exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $book_title = $row["title"];
    $book_author = $row["author"];
    $book_genre = $row["genre"];
    // Display book details
    echo "<h2>Book Details</h2>";
    echo "<p><strong>Title:</strong> $book_title</p>";
    echo "<p><strong>Author:</strong> $book_author</p>";
    echo "<p><strong>Genre:</strong> $book_genre</p>";
} else {
    echo "Book not found";
}

$conn->close();
?>
