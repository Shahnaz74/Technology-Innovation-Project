<?php

    require_once('../databaseConfig.php');

    // Get template_name and field_name from request
    $template_name = $_GET['template_name'] ?? null;
    $field_name = $_GET['field_name'] ?? null;

    // Check if required parameters are provided
    if (!$template_name || !$field_name) {
        http_response_code(400);
        die("Missing required parameters.");
    }

    // Find template_id by template_name
    $sql = "SELECT template_id FROM template WHERE template_name='$template_name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        http_response_code(400);
        die("Template not found.");
    }

    $row = mysqli_fetch_assoc($result);
    $template_id = $row['template_id'];

    // Find field_id by field_name
    $sql = "SELECT field_id FROM field WHERE name='$field_name'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        http_response_code(400);
        die("Field not found.");
    }

    $row = mysqli_fetch_assoc($result);
    $field_id = $row['field_id'];

    // Remove row from fields_in_template table
    $sql = "DELETE FROM fields_in_template WHERE template_id=$template_id AND field_id=$field_id";
    if (mysqli_query($conn, $sql)) {
        http_response_code(200);
        echo "Field detached from template.";
    } else {
        http_response_code(400);
        echo "Error detaching field from template: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);

?>
