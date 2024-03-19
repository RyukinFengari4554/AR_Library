<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Map Page</title>
<section id="title">
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
</style>

</head>
<body>
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content">
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
                    $urlb = $row['loc_url'];
                    $urlb .= '?embed';
                    $genb = $row['genre'];
                     echo "
                     <div class='twinmotion-embed-wrapper'>
                        <iframe style='height: 100%; width: 100%; min-height: 375px; min-width: 375px;'
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
                <a href='javascript:history.back()'><button class='back-button'><i class='fa-solid fa-arrow-left'></i></button></a>  
              </div>
        </div>
    </div>



</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</html>
