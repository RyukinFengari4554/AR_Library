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
  <h1 style="text-align: center;"><i class="fa-solid fa-book-open"></i><br><br>SCAN A BOOK</h1>
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
                        while (count < 30) {
                            document.write('<br>');
                            count++;
                        }
                    </script>
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
  let focusedInput = null;

  function addToInput(char) {
    if (focusedInput) {
            if (char === '') {
        // Handle backspace (delete last character)
        focusedInput.value = focusedInput.value.slice(0, -1);
        } else {
            focusedInput.value += char;
        }
    }
    // Keep the virtual keyboard visible after clicking its buttons
    document.getElementById('virtual-keyboard').style.display = 'block';
  }

  function deleteText() {
    if (focusedInput) {
      focusedInput.value = '';
    }
    // Keep the virtual keyboard visible after clicking its buttons
    document.getElementById('virtual-keyboard').style.display = 'block';
  }

  // Show the virtual keyboard when input box or textarea is focused
document.querySelectorAll('input[type="text"], textarea').forEach(function(element) {
  element.addEventListener('focus', function() {
    focusedInput = element;
    document.getElementById('virtual-keyboard').style.display = 'block';
  });
});
  

  // Hide the virtual keyboard when clicking outside search box or virtual keyboard
  document.addEventListener('click', function(event) {
    const virtualKeyboard = document.getElementById('virtual-keyboard');
    const inputs = document.querySelectorAll('input[type="text"], textarea');
    if (!Array.from(inputs).some(input => input.contains(event.target)) && event.target !== virtualKeyboard && !virtualKeyboard.contains(event.target)) {
      virtualKeyboard.style.display = 'none';
    }
  });

  // Keep the virtual keyboard visible when it is clicked
  document.getElementById('virtual-keyboard').addEventListener('click', function() {
    if (focusedInput) {
      focusedInput.focus();
    }
  });
</script>




</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>

</html>
