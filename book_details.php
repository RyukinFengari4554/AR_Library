<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<title>About the Book Page</title>
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
  <h1 style="text-align: center;"><i class="fa-solid fa-search"></i><br><br>ABOUT THE BOOK</h1>
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
    table{
    background-color: white;
    background-image:none;
    }
    a {
        color: black; 
    } 
    a:visited {
        color: black; 
    }
</style>
</head>
<body  style="background-image: linear-gradient(white , #fa868e); background-attachment: fixed;">
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content">
            <div style="background-color:white;">
            <?php
                // Database connection
                require_once "includes/db.inc.php";
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
                    $book_title = $row["title"];
                    $book_author = $row["author"];
                    $book_year = $row["year"];
                    $book_genre = $row["genre"];
                    $book_author = $row["author"];
                    $book_avail = $row["availability"];
                    $book_desc = $row["description"];
                    $book_shelf = $row["shelf_loc"];
                    $book_cn = $row["call_num"];
                    // Display book details

                    echo "<table style='margin-left: 3rem;'><tr>";
echo "<td>";
echo "<h1><strong>Title:</strong> $book_title</h1>";
echo "</td>";
echo "<td>";
echo "<h2 style='text-align: center; margin-right: 3rem; margin-left: 3rem;'>Availability:<br>";
if ($book_avail==1) {
    echo "<i class='fa-solid fa-circle-check fa-lg' style='color: green;'></i></h2>";
} else {
    echo "<i class='fa-solid fa-circle-xmark fa-lg' style='color: red;'></i></h2>";
}
echo "</td></tr><tr><td>";
echo "<p><strong>Author:</strong> $book_author</p>";
echo "<p><strong>Published:</strong> $book_year</p>";
echo "<p><strong>Genre:</strong> $book_genre</p>";
echo "<p><strong>Call Number:</strong> $book_cn</p>";
echo "<a href='map-all.php?id=" . $book_id . "'><p><strong>Shelf Location:</strong> $book_shelf <strong><i class='fa-solid fa-location-dot'></i></strong></p></a>";
echo "<a href='similar_books.php?id=" . $book_id . "'><p><strong>Similar Books </strong><strong><i class='fa-solid fa-book-open'></i></strong></p></a>";
echo "</td></tr></table><table style='margin-left: 3rem; margin-right: 3rem;'><tr><td>";
echo "<h3 style='margin: 0;'>Plot Summary:</h3>";
echo "<p style='margin: 0; text-align: justify;text-justify: inter-word;'> $book_desc</p>";
echo "</td>";

echo "</tr></table>";


} else {
                    echo "<h2 class='centeral'>Book not found</h2>";
                }

                $mysqli->close();
                ?>
            </div>

            <br>
            <div class="centeral">
                    <br>
                <a href="index.html"><button class="back-button"><i class="fa-solid fa-house"></i></button></a>
                <button onclick="goBack()"  class="back-button" style="font-size: medium;"><i class="fa-solid fa-arrow-left"></i></button>
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
