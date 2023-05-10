<?php
    // Include database configuration file
    require_once('../databaseConfig.php');

    // Set headers to allow cross-origin resource sharing (CORS)
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Content-Type');

    // Check if user_upload_id is set and not empty
    if(isset($_GET['user_upload_id']) && !empty($_GET['user_upload_id'])) {
        
        // Sanitize user_upload_id input
        $user_upload_id = mysqli_real_escape_string($conn, $_GET['user_upload_id']);

        // Update upload_status of the upload to "published"
        $sql = "UPDATE user_uploads SET upload_status = 2 WHERE upload_id = '$user_upload_id'";

        if(mysqli_query($conn, $sql)) {
            // If query is successful, return success message
            $message = "Upload with ID $user_upload_id has been approved";
            http_response_code(200);
        } else {
            // If query fails, return error message
            $message = "An error occurred while approving the upload";
            http_response_code(400);
        }
    } else {
        // If user_upload_id is not set or empty, return error message
        $message = "Invalid input data";
        http_response_code(400);
    }

    // Return JSON response
    echo json_encode(array("message" => $message));
?>
