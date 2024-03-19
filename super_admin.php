<?php
session_start(); // Start PHP session for managing user login state

 // Redirect based on the role
 if(isset($_SESSION["role"])){
    if($_SESSION["role"] === "user"){
        header("location: login-wsa.php"); // Redirect to super_admin.php if the role is super admin
        exit;
    } elseif($_SESSION["role"] === "admin"){
        header("location: admin.php"); // Redirect to admin.php if the role is admin
        exit;
    } 
 }
// Database connection
require_once "includes/db.inc.php";

// Function to update availability in the database
function updateAvailability($bookId, $availability) {
    global $mysqli;
    // SQL query to update the availability of the book with the given ID
    $sql = "UPDATE ar_library.books SET availability = $availability WHERE id = $bookId";
    // Execute the SQL query
    $result = $mysqli->query($sql);
    // Check if the update was successful
    if ($result) {
        return true; // Return true if successful
    } else {
        return false; // Return false if unsuccessful
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SUPER ADMIN PAGE</title>
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
<body>
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
                                Add Marker For Book
                            </div>
                            <div class="card-body">
                                <form id="addBookForm">
                                    <div class="mb-3">
                                        <label for="call_num" class="form-label">Call Number</label>
                                        <input type="text" class="form-control" id="call_num" name="call_num" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="marker_name" class="form-label">Marker Name</label>
                                        <input type="text" class="form-control" id="marker_name" name="marker_name" pattern="[a-zA-Z0-9]+" title="Please enter only letters and/or numbers with no spaces" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="file_input_fset" class="form-label">FSET File</label>
                                        <input type="file" class="form-control" id="file_input_fset" name="file_input_fset" accept=".fset" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="file_input_fset3" class="form-label">FSET3 File</label>
                                        <input type="file" class="form-control" id="file_input_fset3" name="file_input_fset3" accept=".fset3" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="file_input_iset" class="form-label">ISET File</label>
                                        <input type="file" class="form-control" id="file_input_iset" name="file_input_iset" accept=".iset" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="twin_loc" class="form-label">Twinmotion</label>
                                        <input type="text" class="form-control" id="twin_loc" name="twin_loc" pattern="https?://.+" required>
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
                    <a href="catalogue.php"><button class="back-button"><i class="fa-solid fa-search"></i></button></a>
                </div>
        </div>
    </div>



</body>
<script src="https://kit.fontawesome.com/7dd0b53595.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $('#addBookForm').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'update_book.php',
                data: formData,
                success: function(response){
                    console.log(response);
                    alert(response); // Display return statement in alert
                    window.location.href = 'admin.php';
                },
                error: function(error){
                    console.error('Error:', error);
                    alert("Error occurred!"); // Display error message in alert
                    location.reload();
                }
            });
        });
    });
</script>

</html>
