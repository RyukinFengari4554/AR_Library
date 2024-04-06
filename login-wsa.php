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
  <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
    
  </style>
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
  <h1 style="text-align: center;"><i class="fa-solid fa-user"></i><br><br>LOG-IN</h1>
  <hr style="border: 2px solid red;">
  </section>

   <!-- Custom styles for this template -->
   <link href="styles/home.css" rel="stylesheet">
</head>
<body  style="background-image: linear-gradient(white , #fa868e); background-attachment: fixed;">
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
                <?php
                $count = 0;
                while ($count < 5) {
                    echo "<br>";
                    $count++;
                }
                ?>    
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
