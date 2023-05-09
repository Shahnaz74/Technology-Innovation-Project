<?php

  // Retrieve request body
  $request_body = file_get_contents('php://input');

  // Decode JSON data from request body
  $data = json_decode($request_body, true);

  require_once("databaseConfig.php");

  // Prepare SQL statement to insert new upload data
  $sql = "INSERT INTO user_uploads (file_name, contributor, coverage, creator, date, description, format, identifier, language, publisher, relation, rights, source, title, first_name, last_name, email, upload_status, template_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = mysqli_prepare($conn, $sql);

  // Bind parameters with the data
  mysqli_stmt_bind_param($stmt, "ssssssssssssssssssi", 
                          $data['file_name'],
                          $data['contributor'],
                          $data['coverage'],
                          $data['creator'],
                          $data['date'],
                          $data['description'],
                          $data['format'],
                          $data['identifier'],
                          $data['language'],
                          $data['publisher'],
                          $data['relation'],
                          $data['rights'],
                          $data['source'],
                          $data['title'],
                          $data['first_name'],
                          $data['last_name'],
                          $data['email'],
                          $data['upload_status'],
                          $data['template_id']
                         );

  // Execute the statement
  if (mysqli_stmt_execute($stmt)) {

    // Retrieve the newly inserted upload data
    $upload_id = mysqli_insert_id($conn);
    $select_sql = "SELECT * FROM user_uploads WHERE upload_id = '$upload_id'";

    $result = mysqli_query($conn, $select_sql);
    $upload_data = mysqli_fetch_assoc($result);

    // Insert the keywords
    foreach ($data['subject'] as $keyword) {
      $insert_keyword_sql = "INSERT INTO keyword (keyword, upload_id) VALUES ('$keyword', '$upload_id')";
      mysqli_query($conn, $insert_keyword_sql);
    }

    // Return success response with the new upload data
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode(array(
      "message" => "upload has been created successfully",
      "data" => $upload_data
    ));
  } else {
    // Return error response
    http_response_code(400);
    echo "Error: " . mysqli_error($conn);
  }

  // Close database connection
  mysqli_close($conn);

?>
