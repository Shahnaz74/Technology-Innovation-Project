<?php
    require_once('../databaseConfig.php');

    // Initialize response array
    $response = array();

    // Select all keywords from the database
    $query = "SELECT * FROM keyword";
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result) {
        // Fetch data from the database
        $keywords = array();
        while ($row = $result->fetch_assoc()) {
            $keywords[] = $row['keyword'];
        }
        
        // Set response status and data
        $response['status'] = 200;
        $response['data'] = $keywords;
    } else {
        // Set error response
        $response['status'] = 400;
        $response['error'] = "An error occurred while fetching data from the database";
    }

    // Close database connection
    $conn->close();

    // Send response
    header('Content-Type: application/json');
    echo json_encode($response);
?>
