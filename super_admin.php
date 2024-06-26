<?php
session_start(); // Start PHP session for managing user login state

// Redirect if not logged in as super admin
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "super_admin") {
    header("location: login-wsa.php");
    exit;
}

// Database connection
require_once "includes/db.inc.php";

// Initialize message variable
$message = '';

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $call_num = trim($_POST["call_num"]);
    $marker_name = trim($_POST["marker_name"]);
    $twin_loc = trim($_POST["twin_loc"]);

    // Check if all required fields are filled
    if (empty($call_num) || empty($marker_name) || empty($twin_loc)) {
        $message = "Please fill all required fields.";
    } else {
        // Handle file uploads
        $upload_success = true;
        
        do {
            // SQL query to check if the variable exists in the database
            $sql = "SELECT COUNT(*) AS count_variable FROM books WHERE marker = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("s", $marker_name);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();

            // Increment the marker
            $inputString = $marker_name;
            // Extract numeric part from the end of the string
            preg_match('/([0-9]+)$/', $inputString, $matches);

            if (!empty($matches)) {
                // Increment the numeric part
                $numericPart = $matches[0];
                $alphaPart = substr($inputString, 0, -strlen($numericPart));
                $newNumericPart = $numericPart + 1;

                // Concatenate the incremented numeric part with the alpha part
                $marker_name = $alphaPart . $newNumericPart;
                error_log($marker_name);
            } else {
                // If no numeric part found, append '1' to the string
                $marker_name = $inputString . '1';
                error_log($marker_name);
            }
             // Close the statement if it's successfully executed
        } while ($count > 0); // Continue looping as long as the count is greater than 0


        // Check if files are uploaded successfully
        if (isset($_FILES["file_input_fset"]) && isset($_FILES["file_input_fset3"]) && isset($_FILES["file_input_iset"])) {
            // Handle FSET file upload
            $fset_file = $_FILES["file_input_fset"];
            if ($fset_file["error"] == UPLOAD_ERR_OK) {
                $fset_target_dir = "includes/nft-books/";
                $fset_target_file = $fset_target_dir . $marker_name . ".fset"; 
                if (move_uploaded_file($fset_file["tmp_name"], $fset_target_file)) {
                    $message .= "FSET file uploaded successfully.\\n";
                } else {
                    $message .= "Failed to upload FSET file.\\n";
                    $upload_success = false;
                }
            } else {
                $message .= "Error uploading FSET file: " . $fset_file["error"] . "\\n";
                $upload_success = false;
            }

            // Handle FSET3 file upload
            $fset3_file = $_FILES["file_input_fset3"];
            if ($fset3_file["error"] == UPLOAD_ERR_OK) {
                $fset3_target_dir = "includes/nft-books/";
                $fset3_target_file = $fset3_target_dir . $marker_name . ".fset3"; 
                if (move_uploaded_file($fset3_file["tmp_name"], $fset3_target_file)) {
                    $message .= "FSET3 file uploaded successfully.\\n";
                } else {
                    $message .= "Failed to upload FSET3 file.\\n";
                    $upload_success = false;
                }
            } else {
                $message .= "Error uploading FSET3 file: " . $fset3_file["error"] . "\\n";
                $upload_success = false;
            }

            // Handle ISET file upload
            $iset_file = $_FILES["file_input_iset"];
            if ($iset_file["error"] == UPLOAD_ERR_OK) {
                $iset_target_dir = "includes/nft-books/";
                $iset_target_file = $iset_target_dir . $marker_name . ".iset"; 
                if (move_uploaded_file($iset_file["tmp_name"], $iset_target_file)) {
                    $message .= "ISET file uploaded successfully.\\n";
                } else {
                    $message .= "Failed to upload ISET file.\\n";
                    $upload_success = false;
                }
            } else {
                $message .= "Error uploading ISET file: " . $iset_file["error"] . "\\n";
                $upload_success = false;
            }
        } else {
            $message .= "One or more files were not uploaded.\\n";
            $upload_success = false;
        }

        // If file uploads were successful, update database
        if ($upload_success) {
            // Update marker and loc_url using call_num
            $sql = "UPDATE books SET marker = ?, loc_url = ? WHERE call_num = ?";
            $stmt = $mysqli->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("sss", $marker_name, $twin_loc, $call_num);
                if ($stmt->execute()) {
                    $message .= "Book marker and loc_url updated successfully.";
                } else {
                    $message .= "Error updating book marker and loc_url: " . $mysqli->error;
                }
                $stmt->close();
            } else {
                $message .= "Error preparing SQL statement: " . $mysqli->error;
            }
        } else {
            $message .= "One or more files failed to upload. Please try again.";
        }
    }
    echo "<script>alert('$message');</script>";

}

$mysqli->close(); // Close database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SUPER ADMIN PAGE</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


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
              <a class="nav-link links" href="logout.php"><i class="fa-solid fa-user"></i> Logout</a>
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
  <h1 style="text-align: center;"><i class="fa-solid fa-circle-plus"></i><br><br>Super Admin Page</h1>
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
    .fixedbutton {
    position: fixed;
    bottom: 2rem;
    right: 2rem; 
}
</style>

</head>
<body style="background-image: linear-gradient(white , #fa868e); background-attachment: fixed;">
<a href="logout.php"><button class="fixedbutton" style="font-size: medium;"><i class="fa-solid fa-user"></i><br><br>LOG OUT</button></a>
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
                                Add Marker For Book <a href="https://carnaux.github.io/NFT-Marker-Creator/#/" target="_blank" title="Create NFT Marker">(Create Marker)</a>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="call_num" class="form-label">Call Number</label>
                                        <input type="text" class="form-control input-box" id="call_num" name="call_num" required>
                                    </div>
                    
                                        <div class="mb-3">
                                            <label for="marker_name" class="form-label">Marker Name</label>
                                            <input type="text" class="form-control input-box" id="marker_name" name="marker_name" pattern="[a-zA-Z0-9]+" title="Please enter only letters and/or numbers with no spaces" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="file_input_fset" class="form-label">FSET File</label>
                                            <input type="file" class="form-control input-box" id="file_input_fset" name="file_input_fset" accept=".fset" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="file_input_fset3" class="form-label">FSET3 File</label>
                                            <input type="file" class="form-control input-box" id="file_input_fset3" name="file_input_fset3" accept=".fset3" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="file_input_iset" class="form-label">ISET File</label>
                                            <input type="file" class="form-control input-box" id="file_input_iset" name="file_input_iset" accept=".iset" required>
                                        </div>
        
                                    <div class="mb-3">
                                        <label for="twin_loc" class="form-label">Twinmotion</label>
                                        <input type="text" class="form-control input-box" id="twin_loc" name="twin_loc" pattern="https?://.+" required>
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

</html>
