<?php
    require_once('databaseConfig.php');

    // Parse the PUT request body
    parse_str(file_get_contents("php://input"), $_PUT);

    // Check if the required parameters are provided
    if (!isset($_PUT['template_name'])) {
        http_response_code(400);
        echo json_encode(array("message" => "Missing required parameter: template_name"));
        exit;
    }

    $templateName = $_PUT['template_name'];

    // Check if the template exists in the database
    $templateExistsQuery = "SELECT * FROM template WHERE template_name = '$templateName'";
    $templateExistsResult = $conn->query($templateExistsQuery);

    if ($templateExistsResult->num_rows == 0) {
        http_response_code(400);
        echo json_encode(array("message" => "Template not found"));
        exit;
    }

    // Update template data

    // Update template icon if provided
    if (isset($_PUT['template_icon'])) {
        $templateIcon = $_PUT['template_icon'];
        if ($templateIcon === "") {
            $templateIcon = null;
        }
        $updateTemplateIconQuery = "UPDATE template SET template_icon = '$templateIcon' WHERE template_name = '$templateName'";
        $conn->query($updateTemplateIconQuery);
    }

    // Delete existing fields in the fields_in_template table related to the template
    $deleteFieldsInTemplateQuery = "DELETE FROM fields_in_template WHERE template_id = (SELECT template_id FROM template WHERE template_name = '$templateName')";
    $conn->query($deleteFieldsInTemplateQuery);

    // Insert fields into the fields_in_template table
    if (isset($_PUT['fields'])) {
        $fields = $_PUT['fields'];

        foreach ($fields as $field) {
            $fieldName = $field['name'];
            $isRequired = $field['is_required'];

            // Insert new field into the fields_in_template table
            $insertFieldInTemplateQuery = "INSERT INTO fields_in_template (is_required, template_id, field_id) SELECT '$isRequired', (SELECT template_id FROM template WHERE template_name = '$templateName'), field_id FROM field WHERE name = '$fieldName'";
            $conn->query($insertFieldInTemplateQuery);
        }
    }

    // Fetch the updated template data from the database
    $getUpdatedTemplateQuery = "SELECT * FROM template WHERE template_name = '$templateName'";
    $updatedTemplateResult = $conn->query($getUpdatedTemplateQuery);

    if ($updatedTemplateResult->num_rows > 0) {
        $templateData = $updatedTemplateResult->fetch_assoc();

        // Fetch the updated fields from the fields_in_template table
        $getUpdatedFieldsQuery = "SELECT field.name, fields_in_template.is_required FROM field INNER JOIN fields_in_template ON field.field_id = fields_in_template.field_id WHERE fields_in_template.template_id = (SELECT template_id FROM template WHERE template_name = '$templateName')";
        $updatedFieldsResult = $conn->query($getUpdatedFieldsQuery);
        $updatedFields = array();

        while ($row = $updatedFieldsResult->fetch_assoc()) {
            $updatedFields[] = array(
                "name" => $row['name'],
                "is_required" => $row['is_required']
            );
        }
    }

    // Prepare the response data
    $responseData = array(
        "template_name" => $templateData['template_name'],
        "template_icon" => $templateData['template_icon'],
        "fields" => $updatedFields
    );


    // Replace empty strings with null values in the response data
    foreach ($responseData as $key => $value) {
        if ($value === "") {
            $responseData[$key] = null;
        }
    }

    // Return the response as JSON
    http_response_code(200);
    echo json_encode(array("message" => "Template has been updated", "data" => $responseData));
