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

<title>Map Page</title>
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
  <h1 style="text-align: center;"><i class="fa-solid fa-map"></i><br><br>MAP</h1>
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
</style>

</head>
<body style="background-image: linear-gradient(white , #fa868e); background-attachment: fixed;">
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content">
        <form class="centeral action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <div class="centeral">
                <table class="centeral">
                    <tr>
                        <input type="text" title="Please enter the exact name of the book into the search bar to search." class="search-input input-box" placeholder="Search.." id="search" name="query" style="height: 5rem;">
                        <button type="submit" style="height: 5rem;"><i class="fa-solid fa-search"></i></button>
                    </tr>
                    <tr><p><b>Please enter the EXACT Name or Call Number of the book into the search bar to search.</b></p></tr>
                </table>
                <hr style="border: 2px solid black;">
            </div>
        </form>
        <table>
          <?php
          // Initialize $search_query variable
$search_query = "";

if(isset($_GET['query'])) {
    $search_query = $_GET['query'];

    // Escape special characters to prevent SQL injection
    $search_query = $mysqli->real_escape_string($search_query);

    // Query to search for books matching the search query in the 'title' column
    $sql = "SELECT * FROM books WHERE title = '$search_query' OR call_num ='$search_query'";
    $result = $mysqli->query($sql);

    // Display search results
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idb = $row['id'];
        echo "<script>window.location.href = 'map-all.php?id=$idb';</script>";
        exit;
    } else {
        echo "<h3>No results found for: " . htmlspecialchars($search_query)."</h3>";
    }
}
          ?>
        </table>
                  <?php 
                
                // Get book ID from URL parameter
                if (isset($_GET['id'])) {
                    $book_id = $_GET['id'];
                } else {
                    echo 'Book ID not provided';
                    exit();
                }
                 // Query to retrieve book details based on ID
                 $sql = "SELECT * FROM books WHERE id = $book_id";
                 $result = $mysqli->query($sql);
 
                 // Check if book exists
                 if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $urlb = $row['loc_url'];
                    $urlb .= '?embed';
                    $genb = $row['genre'];
                     echo "
                     <p class='centeral'><b>Click the <i class='fa-solid fa-circle-play'></i>(Play) button on the Rght to show where the book is located.</b><p>
                     <div class='twinmotion-embed-wrapper'>
                        <iframe style='height: 100%; width: 100%; min-height: 1000px; min-width: 375px;'
                            title='Embedded presentation &quot;$genb&quot;' frameborder='0'
                            allow='fullscreen; gyroscope; accelerometer; magnetometer; execution-while-out-of-viewport; execution-while-not-rendered; xr-spatial-tracking;'
                            allowfullscreen mozallowfullscreen='true' webkitallowfullscreen='true'
                            src= $urlb>
                        </iframe>
                    </div>
                     ";
                 }
                 else {
                    echo '<h2 class="centeral">Book not found</h2>';
                }
                $mysqli->close();

                  ?>

                <div class="centeral">
                    <br>
                    
                <a href="index.html"><button class="back-button"><i class="fa-solid fa-house"></i></button></a>
                <button onclick="goBack()"  class="back-button"><i class="fa-solid fa-arrow-left"></i></button>
                    <script>
                            function goBack() {
                              localStorage.setItem('messageFromSecond', 'Hello from second.html');
                                history.back();
                            }
                        </script>
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
