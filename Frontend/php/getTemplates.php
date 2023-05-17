<?php
    require_once('databaseConfig.php');

    // Creating an array to store templates data
    $templates = array();

    // Retrieving templates data from the database
    $query = "SELECT template_id, template_name, template_icon FROM template";
    $result = mysqli_query($conn, $query);
    if ($result) {
        while ($template = mysqli_fetch_assoc($result)) {
            // Retrieving fields data related to each template
            $fields = array();
            $query = "SELECT title, name, placeholder, is_required FROM field
                      INNER JOIN fields_in_template ON field.field_id = fields_in_template.field_id
                      WHERE fields_in_template.template_id = " . $template["template_id"];
            $fields_result = mysqli_query($conn, $query);
            if ($fields_result) {
                while ($field = mysqli_fetch_assoc($fields_result)) {
                    $fields[] = $field;
                }
            } else {
                http_response_code(400);
                die("Error: " . mysqli_error($conn));
            }
            $template["fields"] = $fields;
            $templates[] = $template;
        }
        // Encoding the data in JSON format and sending the response
        header("Content-Type: application/json");
        http_response_code(200);
        echo json_encode(array("templates" => $templates));
    } else {
        http_response_code(400);
        die("Error: " . mysqli_error($conn));
    }

    // Closing the database connection
    mysqli_close($conn);
