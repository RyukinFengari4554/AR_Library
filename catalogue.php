<?php
// Database connection
require_once "includes/db.inc.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<title>Catalogue Page</title>
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
              <a class="nav-link links" href="map-whole.php"><i class="fa-solid fa-map"></i> Map</a>
            </li>
            <li class="nav-item">
              <a class="nav-link links" href="login-wsa.php"><i class="fa-solid fa-user"></i> Log-in</a>
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
  <h1 style="text-align: center;"><i class="fa-solid fa-search"></i><br><br>CATALOGUE</h1>
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
    /* Styles for the search button */
    .search-input {
        width: 25rem;
        
        border: 2px solid #ccc;
        border-radius: 5px;
        outline: none;
    }
    .search-button {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 0 5px 5px 0;
        padding: 10px 15px;
        cursor: pointer;
    }
    .search-button:hover {
        background-color: #0056b3;
    }
    input[type="text"]
    {
        font-size:24px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    /* Style for hyperlinks */
    a {
        color: black; 
        text-decoration: none; /* Remove underline */
    }
    
    /* Style for visited hyperlinks */
    a:visited {
        color: black; /* Change the color of visited links to green */
    }
    tr:nth-child(even) {
  background-color: #dddddd;
}
.fixed-buttons {
    position: fixed;
    bottom: 5rem; /* Adjust the distance from the bottom */
    left: 50%; /* Place buttons in the center horizontally */
    transform: translateX(-50%); /* Center buttons horizontally */
    z-index: 9999; /* Ensure buttons appear on top of other content */
  }
</style>

</head>
<body style="background-image: linear-gradient(white , #fa868e); background-attachment: fixed;">
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content">
            
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <div>
                <table class="centeral">
                    <tr>
                        <td><input type="text" class="search-input input-box" placeholder="Search..." id="search" name="query" style="height: 5rem;"></td>
                        <td><button type="submit" style="height: 5rem;"><i class="fa-solid fa-search"></i></button></td>
                    </tr>
                </table>
                <hr style="border: 2px solid black;">
            </div>
        </form>
            
                
            <br>
            <div class="centeral" style="text-align: left;">
            <table>
    
                <tbody>
                    <?php

                    // Initialize $search_query variable
                    $search_query = "";

                    if(isset($_GET['query'])) {
                        $search_query = $_GET['query'];

                        // Escape special characters to prevent SQL injection
                        $search_query = $mysqli->real_escape_string($search_query);

                        // Query to search for books matching the search query in the 'title' column
                        $sql = "SELECT * FROM books WHERE title LIKE '%$search_query%' OR genre LIKE '%$search_query%' OR call_num LIKE '%$search_query%' ORDER BY call_num ASC";
                        $result = $mysqli->query($sql);

                        // Display search results
                        if ($result->num_rows > 0) {
                            echo "<h2>Search results for: " . htmlspecialchars($search_query)."</h2>";
                            echo "<tr><th>Call Number</th><th>Title</th></tr>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td><a href='book_details.php?id=" . $row["id"] . "'>" . $row["call_num"]."</a></td>";
                                echo "<td><a href='book_details.php?id=" . $row["id"] . "'>".$row["title"]."</a></td></tr>";
            
                            }
                        } else {
                            echo "No results found for: " . htmlspecialchars($search_query);
                        }
                        echo "</tbody></table>
                    <div class='centeral'>
                        <br>
                        <div class='fixed-buttons'>
                        <a href='index.html'><button><i class='fa-solid fa-house'></i></button></a>
                        <a href='javascript:history.back()'><button><i class='fa-solid fa-arrow-left'></i></button></a>
                        </div> 
                        </div>";

                    } else {
                        // Query to retrieve all books from the 'books' table
                        $sql = "SELECT * FROM books ORDER BY call_num ASC";
                        $result = $mysqli->query($sql);
                        echo "<tr><th>Call Number</th><th>Title</th></tr>";
                        // Display data in table rows
                        if ($result->num_rows > 0) {

                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td><a href='book_details.php?id=" . $row["id"] . "'>" . $row["call_num"]."</a></td>";
                                echo "<td><a href='book_details.php?id=" . $row["id"] . "'>".$row["title"]."</a></td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>No books found</td></tr>";
                        }
                        echo "</tbody></table>
                        <div class='centeral'>
                            <br>
                            <div class='fixed-buttons'>
                            <a href='index.html'><button><i class='fa-solid fa-house'></i></button></a>
                            <a href='javascript:history.back()'><button><i class='fa-solid fa-arrow-left'></i></button></a>
                            </div> 
                    </div>";
                    }
                    
                    ?>
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

<!-- Bootstrap -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>


</html>
