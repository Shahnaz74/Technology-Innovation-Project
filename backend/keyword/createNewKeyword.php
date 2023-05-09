<?php
// Connect to the database
require_once('databaseConfig.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the POST request contains a new keyword
if(isset($_POST['new_keyword'])) {
    // Sanitize the keyword input
    $newKeyword = mysqli_real_escape_string($conn, $_POST['new_keyword']);

    // Check if the keyword already exists
    $query = "SELECT * FROM keyword WHERE keyword = '$newKeyword'";
    $result = $conn->query($query);
    if($result->num_rows > 0) {
        // Keyword already exists, return error message
        echo "Error: Keyword already exists.";
    } else {
        // Keyword does not exist, add to keyword table
        $query = "INSERT INTO keyword (keyword) VALUES ('$newKeyword')";
        if ($conn->query($query) === TRUE) {
            // Keyword added successfully
            echo "New keyword added: " . $newKeyword;
        } else {
            // Error adding keyword
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
} else {
    // No keyword provided in POST request
    echo "Error: No keyword provided.";
}

// Close database connection
$conn->close();
?>
