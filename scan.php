<?php
require_once "includes/db.inc.php";
session_start();

$nft_books = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $callNumber = $_POST["call_num"];

  // Check if callNumber is 'all'
  if ($callNumber == 'all') {
      $sql = "SELECT id, marker FROM books";
  } else {
    $sql = "SELECT id, marker FROM books WHERE call_num LIKE ?";
    $callNumber = '%' . $callNumber . '%'; // Prepend and append '%' to match partial strings
  }

  // Prepare and execute the SQL query
  $stmt = $mysqli->prepare($sql);

  if ($callNumber != 'all') {
      $stmt->bind_param("s", $callNumber);
  }

  $stmt->execute();

  // Check if the query execution was successful
  if ($stmt) {
      $result = $stmt->get_result();

      // Fetch results and store them in the $nft_books array
      while ($row = $result->fetch_assoc()) {
          $nft_books[$row['id']] = $row['marker'];
      }
      $_SESSION['my_array'] = $nft_books;
      $result->free();
      
  } else {
      // Handle SQL query execution error
      echo "Error: " . $mysqli->error;
  }

  // Close the prepared statement
  $stmt->close();
  if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($nft_books)) {
    header("Location: scan-nft.php");
      exit;
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Scan Page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- Custom styles for this template -->
<link href="styles/home.css" rel="stylesheet">
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
  <h1 style="text-align: center;"><i class="fa-solid fa-book-open"></i><br><br>SCAN A BOOK</h1>
  <hr style="border: 2px solid red;">
  </section>


    
<style>
    .icon {
      font-size: 2.5rem;
      color: #333;
      cursor: pointer;
      transition: color 0.3s;
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
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Enter Call Number
                            </div>
                            <div class="card-body">
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                    <div class="mb-3">
                                    <div class="mb-3">
                                      <div class="mb-3">
                                          <label for="call_num" class="form-label">Please input "all" if you want to load ALL the NFT Markers. <br> Otherwise, please enter the part/whole call number of the book(s).</label>
                                          <input type="text" class="form-control" id="call_num" name="call_num" required>
                                          <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nft_books)) {
                                            echo "<p style='color: red;'>No results found.</p>";
                                        }?>
                                        </div>
                                    <button type="submit" class="back-button">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="centeral">
                  <br>
                    <a href="index.html"><button class="back-button"><i class="fa-solid fa-house"></i></button></a>
                    <a href="javascript:history.back()"><button class="back-button"><i class="fa-solid fa-arrow-left"></i></button></a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

</html>
