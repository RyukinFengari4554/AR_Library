<?php
session_start(); // Start PHP session for managing user login state

// Check if user is logged in as super_admin
if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "super_admin") {
    header("location: login-wsa.php"); // Redirect to login page if not logged in as super_admin
    exit;
}

// Include database connection
require_once "includes/db.inc.php";

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $call_num = trim($_POST["call_num"]);
    $marker_name = trim($_POST["marker_name"]);
    $twin_loc = trim($_POST["twin_loc"]);

    // Check if all required fields are filled
    if(empty($call_num) || empty($marker_name) || empty($twin_loc)) {
        echo "Please fill all required fields.";
    } else { 
        // Check if files are uploaded successfully
        if(isset($_FILES["file_input_fset"]) && $_FILES["file_input_fset"]["error"] == 0 &&
           isset($_FILES["file_input_fset3"]) && $_FILES["file_input_fset3"]["error"] == 0 &&
           isset($_FILES["file_input_iset"]) && $_FILES["file_input_iset"]["error"] == 0) {
            // Handle file uploads
            $upload_success = true; // Flag to track overall upload success

            // Function to handle file upload
            function handleFileUpload($file_input_name, $allowed_types, $max_size, $target_dir) {
                global $upload_success; // Access global variable

                // Get file details
                $file_name = $_FILES[$file_input_name]["name"];
                $file_tmp = $_FILES[$file_input_name]["tmp_name"];
                $file_size = $_FILES[$file_input_name]["size"];

                // Validate file type and size
                if(!in_array(pathinfo($file_name, PATHINFO_EXTENSION), $allowed_types)) {
                    echo "Invalid file type for $file_input_name. Only " . implode(', ', $allowed_types) . " files are allowed.<br>";
                    $upload_success = false;
                } elseif($file_size > $max_size) {
                    echo "File size for $file_input_name exceeds maximum limit (" . ($max_size / 1024 / 1024) . " MB).<br>";
                    $upload_success = false;
                } else {
                    // Move uploaded file to desired location
                    $target_file = $target_dir . $file_name;
                    if(move_uploaded_file($file_tmp, $target_file)) {
                        echo "File uploaded successfully: $file_name<br>";
                    } else {
                        echo "Failed to upload file: $file_name<br>";
                        $upload_success = false;
                    }
                }
            }

            // Handle file uploads for each file type
            handleFileUpload("file_input_fset", array("fset"), 10 * 1024 * 1024, "includes/nft-books/");
            handleFileUpload("file_input_fset3", array("fset3"), 10 * 1024 * 1024, "includes/nft-books/");
            handleFileUpload("file_input_iset", array("iset"), 10 * 1024 * 1024, "includes/nft-books/");

            if($upload_success) {
                // All files uploaded successfully, continue with database update
                // Update marker and loc_url using call_num
                $sql = "UPDATE ar_library.books SET marker = ?, loc_url = ? WHERE call_num = ?";
                if($stmt = $mysqli->prepare($sql)) {
                    // Bind parameters
                    $stmt->bind_param("sss", $marker_name, $twin_loc, $call_num);

                    // Execute statement
                    if($stmt->execute()) {
                        echo "Book marker and loc_url updated successfully.";
                    } else {
                        echo "Error updating book marker and loc_url: " . $mysqli->error;
                    }

                    // Close statement
                    $stmt->close();
                } else {
                    echo "Error preparing SQL statement: " . $mysqli->error;
                }
            } else {
                echo "One or more files failed to upload. Please try again.";
            }
        } else {
            echo "One or more files were not uploaded.";
        }
    }
}

// Close connection
$mysqli->close();
?>
