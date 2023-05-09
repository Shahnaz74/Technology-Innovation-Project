<?php
    // Set header
    header("Content-Type: application/json; charset=UTF-8");

    require_once("databaseConfig.php");

    // Define the query
    $sql = "SELECT user_uploads.*, template.template_name, GROUP_CONCAT(keyword.keyword) AS subject
            FROM user_uploads
            INNER JOIN template ON user_uploads.template_id = template.template_id
            LEFT JOIN keyword ON user_uploads.upload_id = keyword.upload_id
            WHERE upload_status = 1
            GROUP BY user_uploads.upload_id";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        // Define an array to store the uploads
        $uploads_arr = array();

        // Fetch each row of the result
        while ($row = $result->fetch_assoc()) {
            // Define an array to store the current upload
            $upload_item = array(
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
                "source" => $row["source"]
                "subject" => explode(",", $row["subject"]),
                "title" => $row["title"],
                "first_name" => $row["first_name"],
                "last_name" => $row["last_name"],
                "email" => $row["email"],
                "upload_status" => $row["upload_status"],
                "template_name" => $row["template_name"]
            );

            // Add the current upload to the uploads array
            array_push($uploads_arr, $upload_item);
        }

        // Define an array to store the response
        $response = array(
            "uploads" => $uploads_arr
        );

        // Set the HTTP status code to 200 (OK)
        http_response_code(200);

        // Return the response as JSON
        echo json_encode($response);
    } else {
        // Set the HTTP status code to 400 (Bad Request)
        http_response_code(400);

        // Return an error message
        echo json_encode(array("message" => "An error occurred while retrieving the uploads."));
    }

    // Close the database connection
    $conn->close();
?>
