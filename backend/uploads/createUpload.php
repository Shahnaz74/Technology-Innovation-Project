<?php
    // Read the JSON data from the request body
    $requestPayload = file_get_contents('php://input');
    $data = json_decode($requestPayload, true);

    // Extract the data from the JSON payload
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

    require_once('../databaseConfig.php');

    // Insert the data into the user_uploads table
    $insertUploadQuery = "INSERT INTO user_uploads (file_name, contributor, coverage, creator, date, description, format, identifier, language, publisher, relation, rights, source, title, first_name, last_name, email, upload_status, template_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertUploadQuery);
    $stmt->bind_param("sssssssssssssssssi", $file_name, $contributor, $coverage, $creator, $date, $description, $format, $identifier, $language, $publisher, $relation, $rights, $source, $title, $first_name, $last_name, $email, $upload_status);
    $stmt->execute();

    // Get the generated upload ID
    $upload_id = $stmt->insert_id;

    // Prepare the SQL statements for inserting keywords
    $insertKeywordQuery = "INSERT INTO keyword (keyword) VALUES (?)";
    $selectKeywordQuery = "SELECT keyword_id FROM keyword WHERE keyword = ?";
    $insertKeywordStmt = $conn->prepare($insertKeywordQuery);
    $selectKeywordStmt = $conn->prepare($selectKeywordQuery);
    $keywordUploadQuery = "INSERT INTO keyword_upload (upload_id, keyword_id) VALUES (?, ?)";
    $keywordUploadStmt = $conn->prepare($keywordUploadQuery);

    // Loop through each subject keyword and insert into the database
    foreach ($subject as $keyword) {
        $keyword = sanitize($keyword);

        // Check if the keyword already exists
        $selectKeywordStmt->bind_param("s", $keyword);
        $selectKeywordStmt->execute();
        $selectKeywordResult = $selectKeywordStmt->get_result();

        if ($selectKeywordResult->num_rows > 0) {
            // Keyword already exists, retrieve the keyword ID
            $keyword_id = $selectKeywordResult->fetch_assoc()['keyword_id'];
        } else {
            // Keyword doesn't exist, insert it into the keyword table
            $insertKeywordStmt->bind_param("s", $keyword);
            $insertKeywordStmt->execute();

           
            // Get the generated keyword ID
            $keyword_id = $insertKeywordStmt->insert_id;
        }

        // Associate the keyword with the upload in the keyword_upload table
        $keywordUploadStmt->bind_param("ii", $upload_id, $keyword_id);
        $keywordUploadStmt->execute();
    }

    // Close the prepared statements
    $stmt->close();
    $insertKeywordStmt->close();
    $selectKeywordStmt->close();
    $keywordUploadStmt->close();

    // Close the database connection
    $conn->close();

    // Prepare the response JSON
    $response = array(
        'message' => 'Upload has been created successfully',
        'data' => array(
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
        )
    );

    // Set the response headers
    header('Content-Type: application/json');
    http_response_code(200);

    // Send the JSON response
    echo json_encode($response);
?>
