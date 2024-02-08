<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Books Table</title>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
</style>
</head>
<body>

<h2>Books Table</h2>

<table>
    
    <tbody>
        <?php
        // Database connection
        require_once "includes/db.inc.php";
        // Query to retrieve all books from the 'books' table
        $sql = "SELECT * FROM books";
        $result = $mysqli->query($sql);
        
        // Display data in table rows
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><a href='book_details.php?id=" . $row["id"] . "'>" . $row["id"]. ". " . $row["title"] . "</a></td>";
                echo "<td>" . $row["id"] . ". " . $row["title"]. "</td>";
               
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No books found</td></tr>";
        }
        $mysqli->close();
        ?>
    </tbody>
</table>

</body>
</html>
