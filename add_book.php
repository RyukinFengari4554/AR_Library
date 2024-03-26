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
    try {
        // SQL query to insert data into the 'books' table
        $sql = "INSERT INTO books (title, isbn_issn, call_num, shelf_loc, description, author, year, genre, availability) 
                VALUES ('$title', '$isbn_issn', '$call_num', '$shelf', '$description', '$author', '$year', '$genre', '$availability')";

        // Execute the SQL query
        if ($mysqli->query($sql) === TRUE) {
            echo "Book successfully added.";
        } else {
            throw new Exception("Error: " . $mysqli->error);
        }
    } catch (mysqli_sql_exception $exception) {
        // Check if the error is due to a duplicate entry
        if ($exception->getCode() == 1062) {
            echo "Due to the same ISBN or ISSN, the book addition attempt was unsuccessful.";
        } else {
            echo "Error: " . $exception->getMessage();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Close the database connection
        $mysqli->close();
    }
} else {
    // Redirect to a different page if accessed directly
    header("Location: index.php");
    exit();
}
?>