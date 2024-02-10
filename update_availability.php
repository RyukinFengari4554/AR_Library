<?php
// Database connection
require_once "includes/db.inc.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Decode the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract book ID and availability from the decoded data
    $bookId = $data['book_id'];
    $availability = $data['availability'];

    // SQL query to update availability in the database
    $sql = "UPDATE ar_library.books SET availability = $availability WHERE id = $bookId";

    // Execute the SQL query
    $result = $mysqli->query($sql);

    // Check if the update was successful
    if ($result) {
        echo "Availability updated successfully";
    } else {
        echo "Failed to update availability";
    }
}
?>
