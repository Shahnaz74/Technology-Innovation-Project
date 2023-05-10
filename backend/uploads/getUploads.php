<?php
    // Set headers to allow cross-origin requests
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require_once('../databaseConfig.php');

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
        $uploads_arr = array();
        $uploads_arr["uploads"] = array();

        // Loop through all rows and add them to the array
        while ($row = $result->fetch_assoc()) {
            // Extract individual row data
            extract($row);

            // Create upload item array
            $upload_item = array(
                "upload_id" => $upload_id,
                "file_name" => $file_name,
                "contributor" => $contributor,
                "coverage" => $coverage,
                "creator" => $creator,
                "date" => $date,
                "description" => $description,
                "format" => $format,
                "identifier" => $identifier,
                "language" => $language,
                "publisher" => $publisher,
                "relation" => $relation,
                "rights" => $rights,
                "source" => $source,
                "title" => $title,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "upload_status" => $upload_status,
                "template_name" => $template_name,
                "subject" => explode(',', $subject)
            );

            // Add upload item to uploads array
            array_push($uploads_arr["uploads"], $upload_item);
        }

        // Set response code to 200 OK
        http_response_code(200);

        // Output uploads array as JSON
        echo json_encode($uploads_arr);
    } else {
        // Set response code to 400 Bad Request
        http_response_code(400);

        // Output error message
        echo "No uploads found.";
    }

    // Close database connection
    $conn->close();
?>
