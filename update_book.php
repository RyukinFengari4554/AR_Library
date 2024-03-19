<?php
session_start();

if(!isset($_SESSION["role"]) || $_SESSION["role"] !== "super_admin") {
    header("location: login-wsa.php");
    exit;
}

require_once "includes/db.inc.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $call_num = trim($_POST["call_num"]);
    $marker_name = trim($_POST["marker_name"]);
    $twin_loc = trim($_POST["twin_loc"]);

    if(empty($call_num) || empty($marker_name) || empty($twin_loc)) {
        $message = "Please fill all required fields.";
    } else {
        $upload_success = true;

        function handleFileUpload($file_input_name, $allowed_types, $max_size, $target_dir, $new_file_name) {
            global $upload_success;
        
            $file_name = $_FILES[$file_input_name]["name"];
            $file_tmp = $_FILES[$file_input_name]["tmp_name"];
            $file_size = $_FILES[$file_input_name]["size"];
        
            // Validate file type and size
            if (!in_array(pathinfo($file_name, PATHINFO_EXTENSION), $allowed_types)) {
                $message .= "Invalid file type for $file_input_name. Only " . implode(', ', $allowed_types) . " files are allowed.<br>";
                $upload_success = false;
            } elseif ($file_size > $max_size) {
                $message .= "File size for $file_input_name exceeds maximum limit (" . ($max_size / 1024 / 1024) . " MB).<br>";
                $upload_success = false;
            } else {
                // Move uploaded file to desired location with new file name
                $target_file = $target_dir . $new_file_name;
                if (move_uploaded_file($file_tmp, $target_file)) {
                    $message .= "File uploaded successfully: $new_file_name<br>";
                } else {
                    $message .= "Failed to upload file: $new_file_name<br>";
                    $upload_success = false;
                }
            }
        }
        

        handleFileUpload("file_input_fset", array("fset"), 10 * 1024 * 1024, "includes/nft-books/", $marker_name);
        handleFileUpload("file_input_fset3", array("fset3"), 10 * 1024 * 1024, "includes/nft-books/", $marker_name);
        handleFileUpload("file_input_iset", array("iset"), 10 * 1024 * 1024, "includes/nft-books/", $marker_name);

        if($upload_success) {
            $sql = "UPDATE ar_library.books SET marker = ?, loc_url = ? WHERE call_num = ?";
            if($stmt = $mysqli->prepare($sql)) {
                $stmt->bind_param("sss", $marker_name, $twin_loc, $call_num);
                if($stmt->execute()) {
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
    echo $message; // Displaying message directly for simplicity, can be improved for better user experience
    $mysqli->close();
}
?>
