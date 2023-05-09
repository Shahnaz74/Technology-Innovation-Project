<?php

    require_once("databaseConfig.php");

    // check if the template_name parameter was provided in the query string
    if (!isset($_GET['template_name'])) {
      http_response_code(400);
      die("Error: missing template_name parameter");
    }

    // prepare the SQL query to retrieve fields for the specified template
    $template_name = $_GET['template_name'];
    $sql = "SELECT field.type, field.title, field.name, field.placeholder, fields_in_template.is_required
            FROM field
            INNER JOIN fields_in_template ON field.field_id = fields_in_template.field_id
            INNER JOIN template ON fields_in_template.template_id = template.template_id
            WHERE template.template_name = '$template_name'";

    // execute the query and check for errors
    $result = $conn->query($sql);
    if (!$result) {
      http_response_code(400);
      die("Error: " . $conn->error);
    }

    // build the JSON response
    $response = array();
    $response['fields'] = array();
    while ($row = $result->fetch_assoc()) {
      $field = array(
        'name' => $row['name'],
        'title' => $row['title'],
        'placeholder' => $row['placeholder'],
        'is_required' => $row['is_required']
      );
      array_push($response['fields'], $field);
    }
    echo json_encode($response);

    // close the database connection
    $conn->close();

?>
