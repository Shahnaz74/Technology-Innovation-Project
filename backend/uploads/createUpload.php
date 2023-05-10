<?php
  require_once('../databaseConfig.php');

  // Get the request body
  $request_body = file_get_contents('php://input');

  // Decode the JSON data
  $data = json_decode($request_body, true);

  // Insert the upload data into the user_uploads table
  $stmt = $mysqli->prepare("INSERT INTO user_uploads (first_name, last_name, email, upload_status, template_id) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssii", $data["first_name"], $data["last_name"], $data["email"], $data["upload_status"], $data["template_id"]);

  if (!$stmt->execute()) {
    // Handle the error
    echo "Error creating upload: " . $stmt->error;
    exit();
  }

  // Get the upload ID
  $upload_id = $mysqli->insert_id;

  // Insert the keywords into the keyword table if they don't exist, and then insert the relationships into the keyword_upload table
  if (!empty($data["subject"])) {
    $keywords = $data["subject"];

    // Prepare a statement to insert keywords
    $insert_keyword_stmt = $mysqli->prepare("INSERT IGNORE INTO keyword (keyword) VALUES (?)");

    // Prepare a statement to insert keyword-upload relationships
    $insert_relationship_stmt = $mysqli->prepare("INSERT INTO keyword_upload (upload_id, keyword_id) VALUES (?, ?)");

    foreach ($keywords as $keyword) {
      // Insert the keyword if it doesn't exist
      $insert_keyword_stmt->bind_param("s", $keyword);
      $insert_keyword_stmt->execute();

      // Get the keyword ID
      $keyword_id = $mysqli->insert_id;

      // Insert the keyword-upload relationship
      $insert_relationship_stmt->bind_param("ii", $upload_id, $keyword_id);
      $insert_relationship_stmt->execute();
    }
  }

  // Return the success message and upload data
  $response = array(
    "message" => "upload has been created successfully",
    "data" => array_merge(array("upload_id" => $upload_id), $data)
  );

  echo json_encode($response);

  // Close database connection
    $conn->close();
?>
