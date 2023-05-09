<?php
  require_once("databaseConfig.php");

  // Check if upload_id is set
  if (!isset($_REQUEST["upload_id"])) {
    http_response_code(400);
    die("Upload ID not specified");
  }

  // Get the upload_id parameter
  $upload_id = $_REQUEST["upload_id"];

  // Delete keywords related to the upload
  $sql = "DELETE FROM keyword WHERE upload_id = $upload_id";
  if ($conn->query($sql) === FALSE) {
    http_response_code(400);
    die("Error deleting keywords: " . $conn->error);
  }

  // Delete the upload
  $sql = "DELETE FROM user_uploads WHERE upload_id = $upload_id";
  if ($conn->query($sql) === FALSE) {
    http_response_code(400);
    die("Error deleting upload: " . $conn->error);
  }

  // Close the database connection
  $conn->close();

  // Return success message
  http_response_code(200);
  echo "Upload deleted successfully";
?>
