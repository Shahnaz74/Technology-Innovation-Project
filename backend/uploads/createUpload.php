<?php
    // Connect to the database
    require_once('databaseConfig.php');

    // Retrieve the input data
    parse_str(file_get_contents("php://input"), $_POST);

    // Validate required fields
    $requiredFields = ["file", "file_name", "first_name", "last_name", "email", "upload_status", "template_name", "subject"];
    $missingFields = [];
    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || $_POST[$field] === '') {
            $missingFields[] = $field;
        }
    }

    if (!empty($missingFields)) {
        http_response_code(400);
        echo json_encode(["message" => "The following fields are required: " . implode(", ", $missingFields)]);
        exit();
    }

    // Extract data from the input
    $file_name = $_POST["file_name"];
    $file = $_POST["file"];
    $contributor = $_POST["contributor"] ?? null;
    $coverage = $_POST["coverage"] ?? null;
    $creator = $_POST["creator"] ?? null;
    $date = $_POST["date"] ?? null;
    $description = $_POST["description"] ?? null;
    $format = $_POST["format"] ?? null;
    $identifier = $_POST["identifier"] ?? null;
    $language = $_POST["language"] ?? null;
    $publisher = $_POST["publisher"] ?? null;
    $relation = $_POST["relation"] ?? null;
    $rights = $_POST["rights"] ?? null;
    $source = $_POST["source"] ?? null;
    $title = $_POST["title"] ?? null;
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $upload_status = $_POST["upload_status"];
    $template_name = $_POST["template_name"];
    $subject = $_POST["subject"];

    // Find the template_id based on template_name
    $template_id = null;
    $templateQuery = "SELECT template_id FROM template WHERE template_name = '$template_name'";
    $templateResult = $conn->query($templateQuery);
    if ($templateResult->num_rows > 0) {
        $templateRow = $templateResult->fetch_assoc();
        $template_id = $templateRow["template_id"];
    }

    // Insert data into user_uploads table
    $insertQuery = "INSERT INTO user_uploads (file_name, file, contributor, coverage, creator, date, description, format, identifier, language, publisher, relation, rights, source, title, first_name, last_name, email, upload_status, template_id)
        VALUES ('$file_name', '$file', '$contributor', '$coverage', '$creator', '$date', '$description', '$format', '$identifier', '$language', '$publisher', '$relation', '$rights', '$source', '$title', '$first_name', '$last_name', '$email', '$upload_status', '$template_id')";

    if ($conn->query($insertQuery) === true) {
        // Get the upload_id of the newly inserted record
        $upload_id = $conn->insert_id;

        // Insert keywords into keyword table and associate them with the upload
        foreach ($subject as $keyword) {
            // Check if the keyword already exists in the keyword table
            $keyword_id = null;
            $keywordQuery = "SELECT keyword_id FROM keyword WHERE keyword = '$keyword'";
            $keywordResult = $conn->query($keywordQuery);
            if ($keywordResult->num_rows > 0) {
                $keywordRow = $keywordResult->fetch_assoc();
                $keyword_id = $keywordRow["keyword_id"];
            } else {
                // Keyword doesn't exist, insert it into the keyword table
                $keywordInsertQuery = "INSERT INTO keyword (keyword) VALUES ('$keyword')";
                if ($conn->query($keywordInsertQuery) === true) {
                    $keyword_id = $conn->insert_id;
                } else {
                    // Error occurred while inserting keyword
                    http_response_code(400);
                    echo json_encode(["message" => "An error occurred while inserting the keyword."]);
                    $conn->close();
                    exit();
                }
            }

            // Associate the keyword with the upload in the keyword_upload table
            $keywordUploadInsertQuery = "INSERT INTO keyword_upload (upload_id, keyword_id) VALUES ('$upload_id', '$keyword_id')";
            if ($conn->query($keywordUploadInsertQuery) !== true) {
                // Error occurred while associating keyword with upload
                http_response_code(400);
                echo json_encode(["message" => "An error occurred while associating the keyword with the upload."]);
                $conn->close();
                exit();
            }
        }

        // Fetch the complete data of the newly created upload
        $selectQuery = "SELECT * FROM user_uploads WHERE upload_id = '$upload_id'";
        $selectResult = $conn->query($selectQuery);
        if ($selectResult->num_rows > 0) {
            $uploadData = $selectResult->fetch_assoc();

            // Prepare the response
            $response = [
                "message" => "Upload has been created successfully",
                "data" => $uploadData
            ];

            // Return the response
            http_response_code(200);
            echo json_encode($response);
        } else {
            // Error occurred while fetching the upload data
            http_response_code(400);
            echo json_encode(["message" => "An error occurred while fetching the upload data."]);
        }
    } else {
        // Error occurred while inserting the upload
        http_response_code(400);
        echo json_encode(["message" => "An error occurred while creating the upload."]);
    }

    // Close the database connection
    $conn->close();
?>

