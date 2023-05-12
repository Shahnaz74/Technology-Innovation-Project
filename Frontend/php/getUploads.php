<?php
require_once('databaseConfig.php');

// SQL query to fetch data from database
$sql = "SELECT uu.upload_id, uu.file_name, uu.contributor, uu.coverage, uu.creator, uu.date, uu.description, uu.format, uu.identifier, uu.language, uu.publisher, uu.relation, uu.rights, uu.source, uu.title, uu.first_name, uu.last_name, uu.email, uu.upload_status, t.template_name, GROUP_CONCAT(DISTINCT k.keyword SEPARATOR ',') AS subject
            FROM user_uploads AS uu
            JOIN template AS t ON uu.template_id = t.template_id
            LEFT JOIN keyword_upload AS ku ON uu.upload_id = ku.upload_id
            LEFT JOIN keyword AS k ON ku.keyword_id = k.keyword_id
            GROUP BY uu.upload_id";

// Execute query and get results
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    http_response_code(400);
    die("An error occurred while retrieving data: " . $conn->error);
}

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Initialize uploads array
    $uploads = array();

    // Loop through all rows and add them to the array
    while ($row = $result->fetch_assoc()) {
        // Extract individual row data
        // extract($row);

        // Create upload item array
        $upload = array(
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
            "template_name" => $row['template_name'],
            "subject" => explode(",", $row['subject'])
        );

        // Add upload item to uploads array
        $uploads[] = $upload;
    }

    header('Content-Type: application/json');
    // Set response code to 200 OK
    http_response_code(200);

    $response = array("uploads" => $uploads);

    if (!mb_check_encoding($response, 'UTF-8')) {
        $response = mb_convert_encoding($response, 'UTF-8', 'UTF-8');
    }

    // Output uploads array as JSON
    echo json_encode($response);
} else {
    // Set response code to 400 Bad Request
    http_response_code(400);

    // Output error message
    echo "No uploads found.";
}

// Close database connection
$conn->close();
?>