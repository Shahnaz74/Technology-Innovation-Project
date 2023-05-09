<?php
  require_once("databaseConfig.php");

  // Get PUT data
  $data = json_decode(file_get_contents("php://input"), true);

  // Extract data
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

  // Update upload data in user_uploads table
  $sql = "UPDATE user_uploads SET file_name='$file_name', contributor='$contributor', coverage='$coverage', creator='$creator', date='$date', description='$description', format='$format', identifier='$identifier', language='$language', publisher='$publisher', relation='$relation', rights='$rights', source='$source', title='$title', first_name='$first_name', last_name='$last_name', email='$email', upload_status='$upload_status', template_id=(SELECT template_id FROM template WHERE template_name='$template_name') WHERE upload_id='$upload_id'";

  if ($conn->query($sql) === TRUE) {
    // Update keywords
    $keywords = $data['source'];
    $sql = "DELETE FROM keyword WHERE upload_id='$upload_id'";
    $conn->query($sql);
    foreach($keywords as $keyword) {
      $sql = "INSERT INTO keyword (keyword, upload_id) VALUES ('$keyword', '$upload_id')";
      $conn->query($sql);
    }

    // Get updated upload data
    $sql = "SELECT user_uploads.*, template.template_name, GROUP_CONCAT(keyword.keyword SEPARATOR ',') AS source FROM user_uploads LEFT JOIN template ON user_uploads.template_id = template.template_id LEFT JOIN keyword ON user_uploads.upload_id = keyword.upload_id WHERE user_uploads.upload_id='$upload_id' GROUP BY user_uploads.upload_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $response = array(
        'message' => 'upload has been editted successfully',
        'data' => array(
          'upload_id' => $row['upload_id'],
          'file_name' => $row['file_name'],
          'contributor' => $row['contributor'],
          'coverage' => $row['coverage'],
          'creator' => $row['creator'],
          'date' => $row['date'],
          'description' => $row['description'],
          'format' => $row['format'],
          'identifier' => $row['identifier'],
          'language' => $row['language'],
          'publisher' => $row['publisher'],
          'relation' => $row['relation'],
          'rights' => $row['rights'],
          'source' => $row['source'],
          'title' => $row['title'],
          'first_name' => $row['first_name'],
          'last_name' => $row['last_name'],
          'email' => $row['email'],
          'upload_status' => $row['upload_status'],
          'template_name' => $row['template_name']
          )
      );
    } else {
      // If the query failed, prepare the response JSON with an error message
      $response = array(
        'message' => 'Failed to update upload',
        'template' => null
      );
    }

    // Send the response JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    
?>