<?php
require_once('../databaseConfig.php');

// Check if the keyword and user_upload_id were provided
if (isset($_POST['keyword']) && isset($_POST['user_upload_id'])) {

  // Sanitize the input data to prevent SQL injection
  $keyword = mysqli_real_escape_string($conn, $_POST['keyword']);
  $user_upload_id = mysqli_real_escape_string($conn, $_POST['user_upload_id']);

  // Check if the keyword exists in the keyword table
  $keyword_query = "SELECT * FROM keyword WHERE keyword = '$keyword'";
  $keyword_result = mysqli_query($conn, $keyword_query);

  if (mysqli_num_rows($keyword_result) == 0) {
    // If the keyword doesn't exist, insert it into the keyword table
    $insert_keyword_query = "INSERT INTO keyword (keyword) VALUES ('$keyword')";
    mysqli_query($conn, $insert_keyword_query);
    $keyword_id = mysqli_insert_id($conn);
  } else {
    // If the keyword already exists, get its ID
    $keyword_row = mysqli_fetch_assoc($keyword_result);
    $keyword_id = $keyword_row['keyword_id'];
  }

  // Insert the keyword and user_upload_id into the keyword_upload table
  $insert_keyword_upload_query = "INSERT INTO keyword_upload (upload_id, keyword_id) VALUES ('$user_upload_id', '$keyword_id')";
  mysqli_query($conn, $insert_keyword_upload_query);

  // Get all keywords related to the provided upload
  $get_keywords_query = "SELECT keyword FROM keyword INNER JOIN keyword_upload ON keyword.keyword_id = keyword_upload.keyword_id WHERE keyword_upload.upload_id = '$user_upload_id'";
  $get_keywords_result = mysqli_query($conn, $get_keywords_query);
  $keywords = array();
  while ($row = mysqli_fetch_assoc($get_keywords_result)) {
    $keywords[] = $row['keyword'];
  }

  // Return a success message and the related keywords in JSON format
  $response = array(
    "message" => "Keyword has been added successfully to the upload",
    "keyword" => $keywords
  );
  echo json_encode($response);

} else {
  // If the keyword and user_upload_id were not provided, return a 400 error
  http_response_code(400);
  echo json_encode(array("error" => "Bad request"));
}

mysqli_close($conn);
?>
