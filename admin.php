<?php
session_start(); // Start PHP session for managing user login state
error_reporting(E_ALL);
ini_set('display_errors', 1);
 // Redirect based on the role
 if(isset($_SESSION["role"])){
    if($_SESSION["role"] === "super_admin"){
        header("location: super_admin.php"); // Redirect to super_admin.php if the role is super admin
        exit;
    } elseif($_SESSION["role"] === "user"){
        header("location: login-wsa.php"); // Redirect to admin.php if the role is admin
        exit;
    } 
}

// Database connection
require_once "includes/db.inc.php";

// Function to delete data from the database
function deleteBook($bookId) {
    global $mysqli;
    // SQL query to delete the book with the given ID
    $sql = "DELETE FROM books WHERE id = $bookId";
    // Execute the SQL query
    $result = $mysqli->query($sql);
    // Check if the deletion was successful
    if ($result) {
        return true; // Return true if successful
    } else {
        return false; // Return false if unsuccessful
    }
}

// Function to update availability in the database
function updateAvailability($bookId, $availability) {
    global $mysqli;
    // SQL query to update the availability of the book with the given ID
    $sql = "UPDATE books SET availability = $availability WHERE id = $bookId";
    // Execute the SQL query
    $result = $mysqli->query($sql);
    // Check if the update was successful
    if ($result) {
        return true; // Return true if successful
    } else {
        return false; // Return false if unsuccessful
    }
}

// Check if the remove button is clicked and the corresponding book ID is provided
if (isset($_POST['remove_book_id'])) {
    $bookId = $_POST['remove_book_id'];
    // Call the deleteBook function to delete the book
    $deleted = deleteBook($bookId);
    if ($deleted) {
        // Book successfully deleted
        echo "<script>alert('Book removed successfully');</script>";
    } else {
        // Failed to delete the book
        echo "<script>alert('Failed to remove book');</script>";
    }
}

// Check if the sliding button is clicked and the corresponding book ID is provided
if (isset($_POST['book_id']) && isset($_POST['availability'])) {
    $bookId = $_POST['book_id'];
    $availability = $_POST['availability'];
    // Call the updateAvailability function to update the availability
    $updated = updateAvailability($bookId, $availability);
    if ($updated) {
        // Availability updated successfully
        echo "<script>alert('Availability updated successfully');</script>";
    } else {
        // Failed to update availability
        echo "<script>alert('Failed to update availability');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>Admin Page</title>
<section id="title">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #dfbcbc; background-image: linear-gradient(white , #FFE3E5);">
        
        <a class="navbar-brand mb-0 h1" href="index.html"><img src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg" style="width:2rem;height:2rem;"> EAC AR Library</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
      
            <li class="nav-item">
              <a class="nav-link links" href="scan.php"><i class="fa-solid fa-book-open"></i> Scan a Book</a>
            </li>
            <li class="nav-item">
              <a class="nav-link links" href="catalogue.php"><i class="fa-solid fa-search"></i> Catalogue</a>
            </li>
            <li class="nav-item">
              <a class="nav-link links" href="map-whole.php"><i class="fa-solid fa-map"></i> Map</a>
            </li>
            <li class="nav-item">
              <a class="nav-link links" href="logout.php"><i class="fa-solid fa-user"></i> Logout</a>
            </li>
          </ul>
        </div>
      </nav>
      <!--
        <table style="width:100%">
          <tr>
              <td style="width:25%"><img src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg" style="width:50%;height:50%;"> </td>
              <td style="text-align: center;">
                  <h1 style="color: red;">Emilio Aguinaldo College</h1>
                  Gov. D. Mangubat Ave., Brgy. Burol Main, City of Dasmariñas, Cavite 4114, Philippines<br >
                  Tel. Nos. (046) 416-4339/41<br>
                  <a href="https://www.eac.edu.ph" target="_blank" rel="noopener noreferrer">www.eac.edu.ph</a><br>
                  <br>
                  <h3>School of Engineering and Technology</h3>
              </td>
          </tr>
      </table>
      -->
  <hr style="margin-top: 0; border: 2px solid red;">
  <h1 style="text-align: center;">ADMIN</h1>
  <hr style="border: 2px solid red;">
  </section>
<!-- Custom styles for this template -->
<link href="styles/home.css" rel="stylesheet">

    
<style>
    .icon {
      font-size: 2.5rem;
      color: #333;
      cursor: pointer;
      transition: color 0.3s;
    }
    .fixedbutton {
    position: fixed;
    bottom: 2rem;
    right: 2rem; 
}

/* Styles for the sliding button */
.container {
  width: 60px;
  height: 30px;
  background-color: red; /* Red by default */
  border-radius: 15px;
  position: relative;
  cursor: pointer;
  transition: background-color 0.3s;
}

/* Styles for the slider */
.slider {
  width: 30px;
  height: 30px;
  background-color: white;
  border-radius: 50%;
  position: absolute;
  top: 0;
  right: 0; /* Start from the right */
  transition: right 0.3s; /* Animate movement from right to left */
}

/* Styles for the green state */
.container.active .slider {
  right: 30px; /* Move to the left */
}

/* Styles for the green state */
.container.active {
  background-color: green;
}

/* Styles for the centeral class */
.centeral {
  text-align: center;
}
tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

</head>
<body  style="background-image: linear-gradient(white , #fa868e); background-attachment: fixed;">
<a href="logout.php"><button class="fixedbutton" style="font-size: medium;"><i class="fa-solid fa-user"></i><br><br>LOG OUT</button></a>
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content">
            <div>
            <table>
                <thead>
                    <th style='padding-left: 1rem;'>Call Number</th>
                    <th style='padding-left: 1rem;text-align: left;'>Title</th>
                    <th></th>
                    <th>Availability</th>
                </thead>
                <tbody>
            <?php
                        // Query to retrieve all books from the 'books' table in the 'ar_library' database
                        $sql = "SELECT * FROM books ORDER BY id ASC";
                        $result = $mysqli->query($sql);
                        
                        // Display data in table rows
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='padding-left: 1rem;'>" . $row["call_num"] . "</td>";
                                echo "<td style='padding-left: 1rem;'>" . $row["title"] . "</td>";
                                echo "<td><form method='post'><input type='hidden' name='remove_book_id' value='" . $row["id"] . "'><button class='remove-button'>remove</button></form></td>";
                                echo "<td><div class='container toggle-button " . ($row['availability'] == 1 ? 'active' : '') . "' data-book-id='" . $row["id"] . "'><div class='slider'></div></div></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No books found</td></tr>";
                        }
                        echo "<tr><td colspan='4'><div class='centeral'><a href='add.php'><button class='add-button'><i class='fa-solid fa-circle-plus'></i> Add a Book</button></a></div></td></tr>";
                        ?>
        </tbody></table>    
        </div>

            <div class="centeral">
                    <br>
                <a href="index.html"><button class="back-button"><i class="fa-solid fa-house"></i></button></a>
                <script>
                    var count = 0;
                    while (count < 5) {
                        document.write('<br>');
                        count++;
                    }
                </script>    
            </div>
        </div>
    </div>

<script>
    // JavaScript for toggling buttons
    const toggleButtons = document.querySelectorAll('.toggle-button');

    toggleButtons.forEach(button => {
    button.addEventListener('click', () => {
        const bookId = button.dataset.bookId;
        const availability = button.classList.contains('active') ? 0 : 1;
        // AJAX request to update availability
        fetch('update_availability.php', {
            method: 'POST',
            body: JSON.stringify({
                book_id: bookId,
                availability: availability
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            button.classList.toggle('active');
            // Refresh the page after updating availability
            location.reload();
        })
        .catch(error => console.error('Error:', error));
    });
});


    // JavaScript for confirmation prompt when removing a book
    const removeButtons = document.querySelectorAll('.remove-button');

    removeButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const confirmation = confirm('Are you sure you want to remove this book?');
            if (!confirmation) {
                event.preventDefault(); // Prevent form submission if user cancels
            }
        });
    });
</script>
<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>

</html>
