<?php
// Start the session
session_start();

// Set header
header('Content-Type: application/json');

// Get provided keyword from GET request
$providedKeyword = $_GET['provided_keyword'];

// Validate provided keyword
if (!isset($providedKeyword) || empty($providedKeyword)) {
    http_response_code(400);
    $_SESSION["errorString"] = json_encode(array("message" => "An error occured that prevented the page from loading.2"));
    header("location:index.php");
    exit();
}

require_once("databaseConfig.php");

// Check connection
if (!$conn) {
    http_response_code(400);
    $_SESSION["errorString"] = json_encode(array("message" => "An error occured that prevented the page from loading.3"));
    header("location:index.php");
    exit();
}

// Fetch data from database
$sql = "SELECT * FROM user_uploads WHERE upload_status = 2 AND (file_name LIKE '%" . $providedKeyword . "%' OR title LIKE '%" . $providedKeyword . "%')";

$result = mysqli_query($conn, $sql);

if (!$result) {
    http_response_code(400);
    $_SESSION["errorString"] = json_encode(array("message" => "An error occured that prevented the page from loading.4"));
    header("location:index.php");
    exit();
}

// Store results in array
$uploads = array();

while ($row = mysqli_fetch_assoc($result)) {
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
        "template_name" => "",
        "source" => array()
    );

    // Fetch template name
    $templateSql = "SELECT template_name FROM template WHERE template_id = " . $row["template_id"];
    $templateResult = mysqli_query($conn, $templateSql);

    if ($templateResult) {
        $templateRow = mysqli_fetch_assoc($templateResult);
        $upload["template_name"] = $templateRow["template_name"];
    }

    // Fetch keywords
    $keywordsSql = "SELECT keyword FROM keyword WHERE upload_id = " . $row["upload_id"];
    $keywordsResult = mysqli_query($conn, $keywordsSql);

    if ($keywordsResult) {
        while ($keywordRow = mysqli_fetch_assoc($keywordsResult)) {
            array_push($upload["source"], $keywordRow["keyword"]);
        }
    }

    // Add upload to array
    array_push($uploads, $upload);
}

// Close connection
mysqli_close($conn);

// Return data
http_response_code(200);
$jsonString = json_encode(array("uploads" => $uploads));
$_SESSION["jsonString"] = $jsonString;
header("location:search_results.php");
?>