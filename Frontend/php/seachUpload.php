<?php
// Start the session
session_start();


require_once('databaseConfig.php');

// Check if the provided keyword is set
if (isset($_GET['provided_keyword'])) {
  // Get the keyword from the query parameter
  $provided_keyword = $_GET['provided_keyword'];

  // Prepare the SQL statement to search for uploads
  $sql = "SELECT user_uploads.upload_id, user_uploads.file_name, user_uploads.contributor, user_uploads.coverage, user_uploads.creator, user_uploads.date, user_uploads.description, user_uploads.format, user_uploads.identifier, user_uploads.language, user_uploads.publisher, user_uploads.relation, user_uploads.rights, user_uploads.source, user_uploads.title, user_uploads.first_name, user_uploads.last_name, user_uploads.email, upload_status.name AS upload_status, template.template_name, GROUP_CONCAT(keyword.keyword SEPARATOR ', ') AS subject
          FROM user_uploads
          LEFT JOIN upload_status ON user_uploads.upload_status = upload_status.id
          LEFT JOIN template ON user_uploads.template_id = template.template_id
          LEFT JOIN keyword_upload ON user_uploads.upload_id = keyword_upload.upload_id
          LEFT JOIN keyword ON keyword_upload.keyword_id = keyword.keyword_id
          WHERE user_uploads.upload_status = 2 AND (user_uploads.file_name LIKE ? OR keyword.keyword LIKE ?)
          GROUP BY user_uploads.upload_id";
  $stmt = $conn->prepare($sql);
  $search_query = "%" . $provided_keyword . "%";
  $stmt->bind_param("ss", $search_query, $search_query);
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if there are any results
  if ($result->num_rows > 0) {
    // Create an array to store the uploads
    $uploads = array();
    while ($row = $result->fetch_assoc()) {
      // Create an array to store the upload data
      $upload = array(
        "upload_id" => $row["upload_id"],
        "file_name" => $row["file_name"],
        "contributor" => $row["contributor"],
        "coverage" => $row["coverage"],
        "creator" => $row["creator"],
        "date" => $row["date"],
        "description" => $row["description"],
        "format" => $row["format"],
        "identifier" => $row["identifier"],
        "language" => $row["language"],
        "publisher" => $row["publisher"],
        "relation" => $row["relation"],
        "rights" => $row["rights"],
        "source" => $row["source"],
        "title" => $row["title"],
        "first_name" => $row["first_name"],
        "last_name" => $row["last_name"],
        "email" => $row["email"],
        "upload_status" => $row["upload_status"],
        "template_name" => $row["template_name"],
        "subject" => explode(", ", $row["subject"])
      );
      // Add the upload to the uploads array
      array_push($uploads, $upload);
    }
    // Create the response array
    $response = array("uploads" => $uploads);
    // Set the status code to 200
    http_response_code(200);
  } else {
    // If there are no results, create an error response
    $response = array("message" => "No uploads found with provided keyword.");
    // Set the status code to 400
    http_response_code(400);
  }
} else {
  // If the provided keyword is not set, create an error response
  $response = array("message" => "Missing keyword parameter.");
  // Set the status code to 400
  http_response_code(400);
}

// Return the response
$jsonString = json_encode($response);
$_SESSION['jsonString'] = $jsonString;
header("location:search_results.php");
?>