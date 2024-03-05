<?php
// Database connection
require_once "includes/db.inc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $isbn_issn = $_POST['isbn_issn'];
    $call_num = $_POST['call_num'];
    $shelf = $_POST['shelf'];
    $description = $_POST['description'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $availability = $_POST['availability'];

    // SQL query to insert data into the 'books' table
    $sql = "INSERT INTO ar_library.books (title, isbn_issn, call_num, shelf_loc, description, author, year, genre, availability) 
            VALUES ('$title', '$isbn_issn', '$call_num', '$shelf', '$description', '$author', '$year', '$genre', '$availability')";

    // Execute the SQL query
    if ($mysqli->query($sql) === TRUE) {
        echo "Book added successfully";
        header("Location: admin.php");
    exit();
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
} else {
    // Redirect to a different page if accessed directly
    header("Location: admin.php");
    exit();
}
?>
