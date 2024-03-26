<?php
session_start(); // Start PHP session for managing user login state
error_reporting(E_ALL);
ini_set('display_errors', 1);
 // Redirect based on the role
 if(isset($_SESSION["role"])){
    if($_SESSION["role"] === "super_admin"){
        header("location: super_admin.php"); // Redirect to super_admin.php if the role is super admin
        exit;
    } elseif($_SESSION["role"] === "user"){
        header("location: login-wsa.php"); // Redirect to admin.php if the role is admin
        exit;
    } 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Book</title>
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
  <h1 style="text-align: center;"><i class="fa-solid fa-circle-plus"></i><br><br>ADD A BOOK</h1>
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
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Add New Book
                            </div>
                            <div class="card-body">
                                <form id="addBookForm">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="isbn_issn" class="form-label">ISBN/ISSN</label>
                                        <input type="text" class="form-control" id="isbn_issn" pattern="\d+" name="isbn_issn"  title="Please enter a valid number" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="call_num" class="form-label">Call Number</label>
                                        <input type="text" class="form-control" id="call_num" name="call_num" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="shelf" class="form-label">Shelf Location</label>
                                        <input type="text" class="form-control" id="shelf" name="shelf" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="author" class="form-label">Author</label>
                                        <input type="text" class="form-control" id="author" name="author" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="year" class="form-label">Year</label>
                                        <input type="text" class="form-control" id="year" name="year" pattern="\d{4}" title="Please enter a valid year (4 digits)" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="genre" class="form-label">Genre</label>
                                        <input type="text" class="form-control" id="genre" name="genre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="availability" class="form-label">Availability</label>
                                        <input type="number" class="form-control" id="availability" name="availability" min="0" max="1" required>
                                    </div>
                                    <button type="submit" class="back-button">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <div class="centeral">
                    <a href="index.html"><button class="back-button"><i class="fa-solid fa-house"></i></button></a>
                    <button class="back-button" onclick='navigateBackAndReload()'><i class="fa-solid fa-arrow-left"></i></button>
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
                url: 'add_book.php',
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
    function navigateBackAndReload() {
    // Navigate back in history
    history.back();

    // Force reload of the previous page after a short delay (e.g., 500 milliseconds)
    setTimeout(function() {
        location.reload();
    }, 500);
}
</script>
</html>
