<?php
session_start(); // Start PHP session for managing user login state

if(isset($_SESSION["role"])) {
    if($_SESSION["role"] === "super_admin") {
        header("location: super_admin.php"); // Redirect to super_admin.php if the role is super admin
        exit;
    } elseif($_SESSION["role"] === "admin") {
        header("location: admin.php"); // Redirect to admin.php if the role is admin
        exit;
    }
}

// Include config file
require_once "includes/db.inc.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
$_SESSION["role"] = "user";
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement for super_admin table
        $sql_super_admin = "SELECT id, username, password FROM super_admin WHERE username = ?";

        if ($stmt_super_admin = $mysqli->prepare($sql_super_admin)) {
            // Bind variables to the prepared statement as parameters
            $stmt_super_admin->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if ($stmt_super_admin->execute()) {
                // Store result
                $stmt_super_admin->store_result();

                // Check if username exists, if yes then verify password
                if ($stmt_super_admin->num_rows == 1) {
                    // Bind result variables
                    $stmt_super_admin->bind_result($id, $username, $db_password);
                    if ($stmt_super_admin->fetch()) {
                        if ($password == $db_password) { // Compare plaintext passwords directly
                            // Password is correct, start a new session
                            session_start();
                            // Store data in session variables
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["role"] = "super_admin"; // Set session role to super_admin

                            // Redirect user to admin page
                            header("location: super_admin.php");
                        } else {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else {
                    // No super_admin account found, check admin table
                    // Prepare a select statement for admin table
                    $sql_admin = "SELECT id, username, password FROM admin WHERE username = ?";

                    if ($stmt_admin = $mysqli->prepare($sql_admin)) {
                        // Bind variables to the prepared statement as parameters
                        $stmt_admin->bind_param("s", $param_username);

                        // Attempt to execute the prepared statement
                        if ($stmt_admin->execute()) {
                            // Store result
                            $stmt_admin->store_result();

                            // Check if username exists, if yes then verify password
                            if ($stmt_admin->num_rows == 1) {
                                // Bind result variables
                                $stmt_admin->bind_result($id, $username, $db_password);

                                if ($stmt_admin->fetch()) {
                                    if ($password == $db_password) { // Compare plaintext passwords directly
                                        // Password is correct, start a new session
                                        session_start();
                                        // Store data in session variables
                                        $_SESSION["id"] = $id;
                                        $_SESSION["username"] = $username;
                                        $_SESSION["role"] = "admin"; // Set session role to admin

                                        // Redirect user to admin page
                                        header("location: admin.php");
                                    } else {
                                        // Display an error message if password is not valid
                                        $password_err = "The password you entered was not valid.";
                                    }
                                }
                            } else {
                                // Display an error message if username doesn't exist
                                $username_err = "No account found with that username.";
                                $_SESSION["role"] = "user";
                            }
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }

                        // Close statement
                        $stmt_admin->close();
                    }
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt_super_admin->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
    }
    .login-box {
      width: 300px;
      margin: 100px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-box h2 {
      margin-bottom: 20px;
      text-align: center;
    }
    .login-box input[type="text"],
    .login-box input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }
    .login-box input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
    }
    .login-box input[type="submit"]:hover {
      background-color: #0056b3;
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
  <h1 style="text-align: center;"><i class="fa-solid fa-user"></i><br><br>LOG-IN</h1>
  <hr style="border: 2px solid red;">
  </section>

   <!-- Custom styles for this template -->
   <link href="styles/home.css" rel="stylesheet">
</head>
<body>
    <div class="demo-wrap">
        <img
          class="demo-bg"
          src="https://upload.wikimedia.org/wikipedia/en/4/42/Emilio_Aguinaldo_College_seal.svg"
        >
        <div class="demo-content">
            <div class="login-box">
                <h2>Log-in</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" id="input-box" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" id="input-box" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>


            </div>
            <div class="centeral">
                    <br>
                <a href="index.html"><button class="back-button"><i class="fa-solid fa-house"></i></button></a>
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
    const inputBox = document.getElementById('input-box');
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
    const inputBox = document.getElementById('input-box');
    inputBox.value = '';
    // Keep the virtual keyboard visible after clicking its buttons
    document.getElementById('virtual-keyboard').style.display = 'block';
  }

  // Show the virtual keyboard when input box is focused
  document.getElementById('input-box').addEventListener('focus', function() {
    document.getElementById('virtual-keyboard').style.display = 'block';
  });

  // Hide the virtual keyboard when clicking outside search box or virtual keyboard
  document.addEventListener('click', function(event) {
    const virtualKeyboard = document.getElementById('virtual-keyboard');
    const inputBox = document.getElementById('input-box');
    if (event.target !== inputBox && event.target !== virtualKeyboard && !virtualKeyboard.contains(event.target)) {
      virtualKeyboard.style.display = 'none';
    }
  });

  // Keep the virtual keyboard visible when it is clicked
  document.getElementById('virtual-keyboard').addEventListener('click', function() {
    document.getElementById('input-box').focus();
  });
</script>

</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
</html>
