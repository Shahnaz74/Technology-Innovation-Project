<?php
    require_once('databaseConfig.php');

    function filterUploads($keyword, $dateRangeStart, $dateRangeEnd, $templateName, $carType) {
        global $conn;

        // Prepare the SQL query based on the provided filters
        $sql = "SELECT uu.upload_id, uu.file_name, uu.contributor, uu.coverage, uu.creator, uu.date, uu.description,
                uu.format, uu.identifier, uu.language, uu.publisher, uu.relation, uu.rights, uu.source, uu.title,
                uu.first_name, uu.last_name, uu.email, uu.upload_status, t.template_name,
                GROUP_CONCAT(DISTINCT k.keyword) AS subject
                FROM user_uploads uu
                INNER JOIN template t ON uu.template_id = t.template_id
                LEFT JOIN keyword_upload ku ON uu.upload_id = ku.upload_id
                LEFT JOIN keyword k ON ku.keyword_id = k.keyword_id
                WHERE uu.upload_status = 2"; // Only approved uploads

        // Add filters to the SQL query based on the provided parameters
        if (!empty($keyword)) {
            $sql .= " AND (uu.file_name LIKE '%$keyword%' OR uu.title LIKE '%$keyword%' OR uu.description LIKE '%$keyword%'
                      OR k.keyword LIKE '%$keyword%')";
        }
        if (!empty($dateRangeStart)) {
            $sql .= " AND uu.date >= '$dateRangeStart'";
        }
        if (!empty($dateRangeEnd)) {
            $sql .= " AND uu.date <= '$dateRangeEnd'";
        }
        if (!empty($templateName)) {
            $sql .= " AND t.template_name LIKE '%$templateName%'";
        }
        if (!empty($carType)) {
            $sql .= " AND (uu.file_name LIKE '%$carType%' OR uu.title LIKE '%$carType%' OR uu.description LIKE '%$carType%' OR k.keyword LIKE '%$carType%')";
        }

        // Group the results by upload ID
        $sql .= " GROUP BY uu.upload_id";

        // Execute the query
        $result = $conn->query($sql);

        if ($result) {
            $uploads = array();

            // Fetch the results and build the response array
            while ($row = $result->fetch_assoc()) {
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

                $uploads[] = $upload;
            }

            $response = array("uploads" => $uploads);
            return json_encode($response);
        } else {
            return false;
        }
    }

    // Usage
    $provided_keyword = isset($_GET['provided_keyword']) ? $_GET['provided_keyword'] : '';
    $filter_date_range_start = isset($_GET['filter_date_range_start']) ? $_GET['filter_date_range_start'] : '';
    $filter_date_range_end = isset($_GET['filter_date_range_end']) ? $_GET['filter_date_range_end'] : '';
    $filter_template_name = isset($_GET['filter_template_name']) ? $_GET['filter_template_name'] : '';
    $filter_cartype = isset($_GET['filter_cartype']) ? $_GET['filter_cartype'] : '';

    // Call the function to filter uploads
    $result = filterUploads($provided_keyword, $filter_date_range_start, $filter_date_range_end, $filter_template_name, $filter_cartype);

    if ($result) {
        // Set the appropriate response headers
        header('Content-Type: application/json');
        http_response_code(200);

        // Output the result
        echo $result;
    } else {
        // Set the appropriate response headers
        header('Content-Type: application/json');
        http_response_code(400);

        // Output an error message
        echo json_encode(array("message" => "An error occurred."));
    }

?>

