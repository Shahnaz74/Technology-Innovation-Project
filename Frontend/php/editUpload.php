<?php
  // Retrieve the input data
  parse_str(file_get_contents("php://input"), $_PUT);

  // Validate the input
  if (!isset($_PUT['upload_id'])) {
      $response_data = array(
          "message" => "Invalid input. Missing upload_id."
      );
  } else {
      $upload_id = $_PUT['upload_id'];

      require_once('databaseConfig.php');

      // Prepare the update query
      $sql = "UPDATE user_uploads SET ";

      // Iterate through the fields in the input
      foreach ($_PUT as $field => $value) {
          // Skip the upload_id field as it is used in the WHERE clause
          if ($field !== 'upload_id' && $field !== 'subject' && $field !=='template_name') {
              // Consider empty string as null
              $value = ($value === '') ? null : $value;
              $sql .= "$field = " . ($value === null ? "NULL" : "'$value'") . ",";
          }
      }

      // Remove the trailing comma from the query
      $sql = rtrim($sql, ",");

      // Add the WHERE clause to specify the upload_id
      $sql .= " WHERE upload_id = $upload_id";

      // Execute the update query
      if ($conn->query($sql) === TRUE) {
          // Delete existing keywords related to the upload
          $delete_keywords_query = "DELETE FROM keyword_upload WHERE upload_id = $upload_id";
          $conn->query($delete_keywords_query);

          // Insert the new keywords related to the upload
          if (isset($_PUT['subject']) && is_array($_PUT['subject'])) {
              $keywords = $_PUT['subject'];
              foreach ($keywords as $keyword) {
                  $keyword = $conn->real_escape_string($keyword);
                  $insert_keyword_query = "INSERT INTO keyword_upload (upload_id, keyword_id) VALUES ($upload_id, (SELECT keyword_id FROM keyword WHERE keyword = '$keyword'))";
                  $conn->query($insert_keyword_query);
              }
          }

          // Fetch the updated upload data
          $select_query = "SELECT * FROM user_uploads WHERE upload_id = $upload_id";
          $result = $conn->query($select_query);
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();

              // Fetch the keywords related to the upload
              $keyword_query = "SELECT keyword FROM keyword_upload JOIN keyword ON keyword_upload.keyword_id = keyword.keyword_id WHERE upload_id = $upload_id";
              $keyword_result = $conn->query($keyword_query);
              $keywords = array();
              while ($keyword_row = $keyword_result->fetch_assoc()) {
                  $keywords[] = $keyword_row['keyword'];
              }

              // Fetch the template name
              $template_query = "SELECT template_name FROM template WHERE template_id = " . $row['template_id'];
              $template_result = $conn->query($template_query);
              $template_name = $template_result->fetch_assoc()['template_name'];

              // Build the response data
              $response_data = array(
                  "message" => "Upload has been edited successfully",
                  "data" => array(
                      "upload_id" => $row['upload_id'],
                      "file_name" => $row['file_name'],
                      "contributor" => $row['contributor'],
                      "coverage" => $row['coverage'],
                      "creator" => $row['creator'],
                      "date" => $row['date'],
                      "description" => $row['description'],
                      "format" => $row['format'],
                      "identifier" => $row['identifier'],
                      "language" => $row['language'],
                      "publisher" => $row['publisher'],
                      "relation" => $row['relation'],
                      "rights" => $row['rights'],
                      "source" => $row['source'],
                      "title" => $row['title'],
                      "first_name" => $row['first_name'],
                      "last_name" => $row['last_name'],
                      "email" => $row['email'],
                      "upload_status" => $row['upload_status'],
                      "template_name" => $template_name,
                      "subject" => $keywords
                  )
              );
          } else {
              $response_data = array(
                  "message" => "Failed to fetch the updated upload data."
              );
          }
      } else {
          $response_data = array(
              "message" => "Failed to edit the upload."
          );
      }

      // Close the database connection
      $conn->close();
  }

  // Send the response as JSON
  header('Content-Type: application/json');
  echo json_encode($response_data);
?>
