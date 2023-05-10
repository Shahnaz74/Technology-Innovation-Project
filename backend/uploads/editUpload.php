<?php
    include('databaseConfig.php');

    // Read the request body
    $request_body = file_get_contents('php://input');

    // Decode the request body
    $data = json_decode($request_body, true);

    // Extract the data
    $upload_id = $data['upload_id'];
    $file_name = $data['file_name'];
    $contributor = $data['contributor'];
    $coverage = $data['coverage'];
    $creator = $data['creator'];
    $date = $data['date'];
    $description = $data['description'];
    $format = $data['format'];
    $identifier = $data['identifier'];
    $language = $data['language'];
    $publisher = $data['publisher'];
    $relation = $data['relation'];
    $rights = $data['rights'];
    $source = $data['source'];
    $title = $data['title'];
    $first_name = $data['first_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $upload_status = $data['upload_status'];
    $template_name = $data['template_name'];
    $subject = $data['subject'];

    // Start a database transaction
    $conn->begin_transaction();

    try {
      // Update the user_upload table
      $sql = "UPDATE user_uploads SET
        file_name = '$file_name',
        contributor = '$contributor',
        coverage = '$coverage',
        creator = '$creator',
        date = '$date',
        description = '$description',
        format = '$format',
        identifier = '$identifier',
        language = '$language',
        publisher = '$publisher',
        relation = '$relation',
        rights = '$rights',
        source = '$source',
        title = '$title',
        first_name = '$first_name',
        last_name = '$last_name',
        email = '$email',
        upload_status = $upload_status
        WHERE upload_id = $upload_id";

      $conn->query($sql);

      // Update the keyword_upload table
      // First, delete all the existing keywords for the upload
      $sql = "DELETE FROM keyword_upload WHERE upload_id = $upload_id";
      $conn->query($sql);

      // Then, insert the new keywords
      foreach ($subject as $keyword) {
        // Check if the keyword already exists in the keyword table
        $sql = "SELECT keyword_id FROM keyword WHERE keyword = '$keyword'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
          // The keyword does not exist, so insert it into the keyword table
          $sql = "INSERT INTO keyword (keyword) VALUES ('$keyword')";
          $conn->query($sql);

          // Get the newly inserted keyword ID
          $keyword_id = $conn->insert_id;
        } else {
          // The keyword already exists, so get its ID
          $row = $result->fetch_assoc();
          $keyword_id = $row['keyword_id'];
        }

        // Insert the keyword-upload association into the keyword_upload table
        $sql = "INSERT INTO keyword_upload (upload_id, keyword_id) VALUES ($upload_id, $keyword_id)";
        $conn->query($sql);
      }

      // Commit the transaction
      $conn->commit();

      // Return the response
      $response = [
          'message' => 'Upload has been edited successfully',
          'data' => [
              'upload_id' => $upload_id,
              'file_name' => $file_name,
              'contributor' => $contributor,
              'coverage' => $coverage,
              'creator' => $creator,
              'date' => $date,
              'description' => $description,
              'format' => $format,
              'identifier' => $identifier,
              'language' => $language,
              'publisher' => $publisher,
              'relation' => $relation,
              'rights' => $rights,
              'source' => $source,
              'title' => $title,
              'first_name' => $first_name,
              'last_name' => $last_name,
              'email' => $email,
              'upload_status' => $upload_status,
              'template_name' => $template_name,
              'subject' => $subject
          ]
      ];

    // Close the database connection
    mysqli_close($conn);

    header('Content-Type: application/json');
    // Return the response
    echo json_encode($response);
?>