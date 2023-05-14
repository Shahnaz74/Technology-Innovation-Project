<?php

    // Set the response header to JSON
    header('Content-Type: application/json');

    // Check if the upload_id parameter is provided
    if (!isset($_GET['upload_id'])) {
      // If upload_id is missing, return a 400 error response
      http_response_code(400);
      echo json_encode(array('error' => 'Missing upload_id parameter'));
      exit;
    }

    // Get the upload_id from the request
    $uploadId = $_GET['upload_id'];

    require_once('databaseConfig.php');

    // Prepare the SQL query to retrieve upload data based on upload_id
    $query = "SELECT user_uploads.*, template.template_name FROM user_uploads JOIN template ON user_uploads.template_id = template.template_id WHERE upload_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $uploadId);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Check if the upload exists
    if ($result->num_rows === 0) {
      // If the upload does not exist, return a 400 error response
      http_response_code(400);
      echo json_encode(array('error' => 'Upload not found'));
      exit;
    }

    // Fetch the upload data
    $upload = $result->fetch_assoc();

    $stmt->close();

    // Prepare the SQL query to retrieve keywords related to the upload
    $query = "SELECT keyword FROM keyword_upload JOIN keyword ON keyword_upload.keyword_id = keyword.keyword_id WHERE upload_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $uploadId);
    $stmt->execute();

    // Fetch the keywords
    $keywords = array();
    $keywordResult = $stmt->get_result();
    while ($row = $keywordResult->fetch_assoc()) {
      $keywords[] = $row['keyword'];
    }

    // Add the keywords to the upload data
    $upload['subject'] = $keywords;

    // Close the database connection
    $stmt->close();
    $conn->close();

    // Return the upload data as JSON response
    http_response_code(200);
    echo json_encode(array('uploads' => array($upload)));

?>
