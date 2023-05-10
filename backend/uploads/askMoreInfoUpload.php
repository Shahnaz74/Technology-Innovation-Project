<?php
    require_once "databaseConfig.php"; // include database connection

    // check if user_upload_id parameter exists
    if (isset($_GET['user_upload_id'])) {
      $user_upload_id = $_GET['user_upload_id'];

      // update the upload status of the upload to "archived" (3 in upload_status table)
      $update_query = "UPDATE user_uploads SET upload_status = 3 WHERE upload_id = ?";
      $stmt = $mysqli->prepare($update_query);
      $stmt->bind_param("i", $user_upload_id);
      if ($stmt->execute()) {
        // send an email to ask for more information
        $to = "example@example.com";
        $subject = "More information required for the upload";
        $message = "Dear uploader,\n\nWe need more information about your recent upload. Please provide us with additional information.\n\nThank you,\nDocument Management Team";
        $headers = "From: example@example.com" . "\r\n" .
                   "Reply-To: example@example.com" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
          // return success message
          http_response_code(200);
          echo json_encode(array("message" => "Email sent to the uploader."));
        } else {
          // return error message
          http_response_code(400);
          echo json_encode(array("message" => "An error occurred while sending the email."));
        }
      } else {
        // return error message
        http_response_code(400);
        echo json_encode(array("message" => "An error occurred while updating the upload status."));
      }
    } else {
      // return error message
      http_response_code(400);
      echo json_encode(array("message" => "Missing parameter user_upload_id."));
    }
?>
