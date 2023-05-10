<?php
    require_once('../databaseConfig.php');

    // Get the keyword and user_upload_id from frontend
    $keyword = $_POST['keyword'];
    $user_upload_id = $_POST['user_upload_id'];

    // Remove the row in the keyword table that matches the keyword and user_upload_id
    $sql = "DELETE FROM keyword WHERE keyword = '$keyword' AND upload_id = '$user_upload_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Keyword detached successfully";
    } else {
        echo "Error deleting row: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
?>
