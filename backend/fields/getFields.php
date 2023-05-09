<?php
    require_once("databaseConfig.php");

    // Check if template_id is provided
    if (!isset($_GET['template_id'])) {
        // Return error response
        http_response_code(400);
        echo json_encode(array('error' => 'template_id is required'));
        exit();
    }

    // Prepare and execute query to get fields for the given template_id
    $sql = "SELECT * FROM fields WHERE template_id = " . $_GET['template_id'];
    $result = $conn->query($sql);

    // Check if query returned any data
    if ($result->num_rows > 0) {
        // Initialize empty array to store data
        $data = array();

        // Loop through result and add data to array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        // Return success response with data
        http_response_code(200);
        echo json_encode(array('data' => $data));
    } else {
        // Return error response if no data found
        http_response_code(404);
        echo json_encode(array('error' => 'No fields found for the given template_id'));
    }

    // Close database connection
    $conn->close();

?>
