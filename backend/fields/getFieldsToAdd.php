<?php
    // Include the database configuration file
    require_once('../databaseConfig.php');

    // Check if the template name is provided in the GET request
    if(isset($_GET['template_name'])) {
        // Get the template name from the GET request
        $template_name = $_GET['template_name'];

        // Prepare the SQL query to get the fields that are not related to the provided template
        $sql = "SELECT * FROM field WHERE field_id NOT IN (SELECT field_id FROM fields_in_template WHERE template_id = (SELECT template_id FROM template WHERE template_name = ?))";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("s", $template_name);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if there are any fields that are not related to the provided template
        if($result->num_rows > 0) {
            // Create an array to store the fields
            $fields_arr = array();

            // Loop through the result and add each field to the array
            while($row = $result->fetch_assoc()) {
                $field_item = array(
                    "name" => $row['name'],
                    "title" => $row['title'],
                    "placeholder" => $row['placeholder']
                );

                // Add the field to the fields array
                array_push($fields_arr, $field_item);
            }

            // Create an array to store the response
            $response_arr = array(
                "fields" => $fields_arr
            );

            // Set the HTTP status code to 200 OK
            http_response_code(200);

            // Send the response as JSON
            echo json_encode($response_arr);
        } else {
            // Set the HTTP status code to 400 Bad Request
            http_response_code(400);

            // Send an error message as JSON
            echo json_encode(array("message" => "No fields found."));
        }
    } else {
        // Set the HTTP status code to 400 Bad Request
        http_response_code(400);

        // Send an error message as JSON
        echo json_encode(array("message" => "Missing template name."));
    }
?>
