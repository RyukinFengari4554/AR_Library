<?php
// Database connection
require_once "includes/db.inc.php";

?>
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
    /*
    .image-container {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    .image-whole {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
    }

    .image-whole img {
      max-width: 100%;
      height: 1000%;
    }

    .centeral {
      position: relative;
      z-index: 1;
    }
    */
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
    
</style>

</head>
<body>
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content centeral">
          <div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <div>
                <table class="centeral">
                    <tr>
                        <td><input type="text" class="search-input" placeholder="Search..." id="search" name="query" style="height: 5rem;"></td>
                        <td><button type="submit" style="height: 5rem;"><i class="fa-solid fa-search"></i></button></td>
                    </tr>
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
            $sql = "SELECT * FROM books WHERE title = '$search_query' OR genre = '$search_query'";
            $result = $mysqli->query($sql);

            // Display search results
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
                if($row["genre"]=="Fiction"){
                  header("Location: map-fic.html");
                  exit;
                }
                elseif($row["genre"]=="Filipiniana"){
                  header("Location: map-fil.html");
                  exit;
                }
                elseif($row["genre"]=="Reference"){
                  header("Location: map-ref.html");
                  exit;
                }
                elseif($row["genre"]=="Foreign"){
                  header("Location: map-for.html");
                  exit;
                }
                else{
                  header("Location: map-med.html");
                  exit;
                }
            } else {
                echo "<h3>No results found for: " . htmlspecialchars($search_query)."</h3>";
            }
          }

            ?>
        </table>
          </div>
        <div class="image-container">
        <div class="image-whole">
            <img src="https://media.discordapp.net/attachments/784407919487746068/1214612400859512932/Image7.png?ex=6602f972&is=65f08472&hm=54e0aceb73cd38962d45691ca2521cc450371ac6b0e4b319fe3e1c417ba1a7db&=&format=webp&quality=lossless&width=1396&height=339" alt="Your Image">
        <br>
        <br>
        </div>
        </div>
        <div class="centeral" >
          <br>
          <a href="index.html"><button class="back-button"><i class="fa-solid fa-house"></i></button></a>
        </div>
           
          </div>
          
    </div>
   
      <div class="image-whole">
        
  

      </div>
</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
<script src="java/signin.js" charset="utf-8"></script>

</html>
