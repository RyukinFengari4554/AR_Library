<?php
// Database connection
require_once "includes/db.inc.php";

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
    .keyboard-section {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin-bottom: 10px;
  }

  .keyboard-section button {
    margin: 5px;
    padding: 15px 25px;
    font-size: 20px;
    border: 2px solid #ccc; /* Added border for button outline */
    border-radius: 10px;
    background-color: #303030;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .keyboard-section button:hover {
    background-color: #e0e0e0;
  }

  #virtual-keyboard {
    display: none;
    position: fixed;
    bottom: 0;
    width: 100%;
    background-color: #808080;
    border-top: 1px solid #ccc;
    padding: 10px 0;
    box-sizing: border-box;
  }

  .keyboard-half {
    width: 50%;
    margin-bottom: 20px; /* Adjust the margin bottom as needed */
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
                    <a href='index.html'><button class='back-button'><i class='fa-solid fa-house'></i></button></a>
                    <a href='javascript:history.back()'><button class='back-button'><i class='fa-solid fa-arrow-left'></i></button></a>
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
                        <a href='index.html'><button class='back-button'><i class='fa-solid fa-house'></i></button></a>
                        </div>";
                    }
                    
                    ?>
                
            </div>
        </div>
    </div>


  <!-- Virtual Keyboard -->
  <div id="virtual-keyboard">
  <!-- Alphanumeric and Special characters keyboard section -->
  <div class="keyboard-section">
    <!-- Alphanumeric keys -->
    <div class="keyboard-half">
      <button onclick="addToInput('1')">1</button>
      <button onclick="addToInput('2')">2</button>
      <button onclick="addToInput('3')">3</button>
      <button onclick="addToInput('4')">4</button>
      <button onclick="addToInput('5')">5</button>
      <button onclick="addToInput('6')">6</button>
      <button onclick="addToInput('7')">7</button>
      <button onclick="addToInput('8')">8</button>
      <button onclick="addToInput('9')">9</button>
      <button onclick="addToInput('0')">0</button>
      
      <button onclick="addToInput('q')">q</button>
      <button onclick="addToInput('w')">w</button>
      <button onclick="addToInput('e')">e</button>
      <button onclick="addToInput('r')">r</button>
      <button onclick="addToInput('t')">t</button>
      <button onclick="addToInput('y')">y</button>
      <button onclick="addToInput('u')">u</button>
      <button onclick="addToInput('i')">i</button>
      <button onclick="addToInput('o')">o</button>
      <button onclick="addToInput('p')">p</button>
      <button onclick="addToInput('a')">a</button>
      <button onclick="addToInput('s')">s</button>
      <button onclick="addToInput('d')">d</button>
      <button onclick="addToInput('f')">f</button>
      <button onclick="addToInput('g')">g</button>
      <button onclick="addToInput('h')">h</button>
      <button onclick="addToInput('j')">j</button>
      <button onclick="addToInput('k')">k</button>
      <button onclick="addToInput('l')">l</button>
      <button onclick="addToInput('z')">z</button>
      <button onclick="addToInput('x')">x</button>
      <button onclick="addToInput('c')">c</button>
      <button onclick="addToInput('v')">v</button>
      <button onclick="addToInput('b')">b</button>
      <button onclick="addToInput('n')">n</button>
      <button onclick="addToInput('m')">m</button>
      <button onclick="addToInput(' ')">Space</button> 

    </div>
    <!-- Special characters keys -->
    <div class="keyboard-half">
      <button onclick="addToInput('!')">!</button>
      <button onclick="addToInput('@')">@</button>
      <button onclick="addToInput('#')">#</button>
      <button onclick="addToInput('$')">$</button>
      <button onclick="addToInput('%')">%</button>
      <button onclick="addToInput('^')">^</button>
      <button onclick="addToInput('&')">&</button>
      <button onclick="addToInput('-')">-</button>
      <button onclick="addToInput('*')">*</button>
      <button onclick="addToInput('(')">(</button>
      <button onclick="addToInput(')')">)</button>
      <button onclick="addToInput('_')">_</button>
      <button onclick="addToInput('+')">+</button>
      <button onclick="addToInput('{')">{</button>
      <button onclick="addToInput('[')">[</button>
      <button onclick="addToInput('}')">}</button>
      <button onclick="addToInput(']')">]</button>
      <button onclick="addToInput(':')">:</button>
      <button onclick="addToInput(';')">;</button>
      <button onclick="addToInput('&quot;')">"</button>
      <button onclick="addToInput('|')">|</button>
      <button onclick="addToInput('\\')">\</button>
      <button onclick="addToInput('&lt;')">&lt;</button>
      <button onclick="addToInput('.')">.</button>
      <button onclick="addToInput(',')">,</button>
      <button onclick="addToInput('?')">?</button>
      <button onclick="addToInput('/')">/</button>
      <button onclick="addToInput('~')">~</button>
      <button onclick="addToInput('`')">`</button>
      <button onclick="deleteText()">Delete</button>
      <button onclick="addToInput('')">Backspace</button>
    </div>
  </div>
</div>



<script>
  function addToInput(char) {
    const inputBox = document.getElementsByClassName('input-box')[0]; // Assuming there's only one input box
    if (char === '') {
      // Handle backspace (delete last character)
      inputBox.value = inputBox.value.slice(0, -1);
    } else {
      inputBox.value += char;
    }
    // Keep the virtual keyboard visible after clicking its buttons
    document.getElementById('virtual-keyboard').style.display = 'block';
  }

  function deleteText() {
    const inputBox = document.getElementsByClassName('input-box')[0]; // Assuming there's only one input box
    inputBox.value = '';
    // Keep the virtual keyboard visible after clicking its buttons
    document.getElementById('virtual-keyboard').style.display = 'block';
  }

  // Show the virtual keyboard when input box is focused
  document.querySelector('.input-box').addEventListener('focus', function() {
    document.getElementById('virtual-keyboard').style.display = 'block';
  });

  // Hide the virtual keyboard when clicking outside search box or virtual keyboard
  document.addEventListener('click', function(event) {
    const virtualKeyboard = document.getElementById('virtual-keyboard');
    const inputBox = document.querySelector('.input-box');
    if (event.target !== inputBox && !virtualKeyboard.contains(event.target)) {
      virtualKeyboard.style.display = 'none';
    }
  });

  // Keep the virtual keyboard visible when it is clicked
  document.getElementById('virtual-keyboard').addEventListener('click', function() {
    document.querySelector('.input-box').focus();
  });
</script>

</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>


</html>
