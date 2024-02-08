<?php
if(isset($_GET['query'])) {
    $search_query = $_GET['query'];
    // Perform search operations based on $search_query
    // For example, you can execute a database query here to search for matching records
    echo "You searched for: " . $search_query;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Catalogue Page</title>
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
</style>

</head>
<body>
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content">
            
                <form action="search.php" method="GET">
                    <div>
                        <table  class="centeral">
                            <tr>
                                <td><input type="text" class="search-input" placeholder="Search..." id="search" name="query" style="height: 5rem;"></td>
                                <td><button type="submit" style="height: 5rem;"><i class="fa-solid fa-search"></i></button></td>
                            </tr>
                        </table>
                        <hr style="border: 2px solid black;">
                  </div>
                </form>
            
                
            <br>
            <div class="centeral">
                <a href="index.html"><button class="back-button">Back</button></a>
            </div>
        </div>
    </div>



</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
<script src="java/signin.js" charset="utf-8"></script>

</html>