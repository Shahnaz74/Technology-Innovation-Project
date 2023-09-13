<?php
    // Check if the upload_id parameter is set
    if (!isset($_GET['upload_id'])) {
      http_response_code(400);
      echo json_encode(array('message' => 'Missing upload_id parameter.'));
      exit();
    }

    // Get the upload_id parameter
    $upload_id = $_GET['upload_id'];

    require_once('databaseConfig.php');

    // Check if the connection was successful
    if ($conn->connect_error) {
      http_response_code(400);
      echo json_encode(array('message' => 'Failed to connect to database: ' . $conn->connect_error));
      exit();
    }

    // Delete the keywords related to the upload
    $sql = "DELETE FROM keyword_upload WHERE upload_id = " . $upload_id;

    if (!$conn->query($sql)) {
      http_response_code(400);
      echo json_encode(array('message' => 'Failed to delete keywords: ' . $conn->error));
      exit();
    }

    // Delete the upload
    $sql = "DELETE FROM user_uploads WHERE upload_id = " . $upload_id;

    if (!$conn->query($sql)) {
      http_response_code(400);
      echo json_encode(array('message' => 'Failed to delete upload: ' . $conn->error));
      exit();
    }

    // Close the database connection
    $conn->close();

    // Return a success message
    http_response_code(200);
    echo json_encode(array('message' => 'Upload deleted successfully.'));
?>
