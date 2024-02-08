<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About the Book Page</title>
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
</style>
</head>
<body>
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
                    $book_year = $row["date"];
                    $book_genre = $row["genre"];
                    $book_author = $row["author"];
                    $book_avail = $row["availability"];
                    $book_desc = $row["description"];
                    $book_section = $row["section"];
                    // Display book details
                    echo "<h2>Book Details</h2>";
                    echo "<p><strong>Title:</strong> $book_title</p>";
                    echo "<p><strong>Author:</strong> $book_author</p>";
                    echo "<p><strong>Published:</strong> $book_year</p>";
                    echo "<p><strong>Genre:</strong> $book_genre</p>";
                    echo "<p><strong>Availability:</strong>";
                    if ($book_avail==1){
                        echo "YES</p>"; // need check mark icon
                    }
                    else
                    {
                        echo "NO</p>"; // X mark icon
                    }
                    echo "<p><strong>Book Section:</strong> $book_section</p>"; //updasted later
                    echo "<h3>Plot Summary:</h3><p style='text-align: justify;text-justify: inter-word;'> $book_desc</p>";
                } else {
                    echo "<h2 class='centeral'>Book not found</h2>";
                }

                $mysqli->close();
                ?>
            </div>

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
