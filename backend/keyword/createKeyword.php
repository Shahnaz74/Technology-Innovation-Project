<?php
    require_once("databaseConfig.php");

    // get the new keyword and user_upload_id from the request
    $newKeyword = $_POST['newKeyWord'];
    $userUploadId = $_POST['user_upload_id'];

    // prepare the SQL statement to insert a new row into the keyword table
    $sql = "INSERT INTO keyword (keyword, upload_id) VALUES ('$newKeyword', '$userUploadId')";

    // execute the SQL statement
    if ($conn->query($sql) === TRUE) {
        // prepare the SQL statement to update the user_uploads table to add the keyword
        $sql = "UPDATE user_uploads SET keyword_id = (SELECT id FROM keyword WHERE keyword = '$newKeyword' AND upload_id = '$userUploadId') WHERE upload_id = '$userUploadId'";

        // execute the SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "New keyword added successfully";
        } else {
            echo "Error updating user_uploads table: " . $conn->error;
        }
    } else {
        echo "Error inserting new row into keyword table: " . $conn->error;
    }

    // close the database connection
    $conn->close();

?>
