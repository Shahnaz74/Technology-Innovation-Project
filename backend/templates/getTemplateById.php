<?php
    // Connect to the database
    require_once('../databaseConfig.php');

    // Check if template_name is provided
    if (!isset($_GET['template_name'])) {
        http_response_code(400);
        echo json_encode(["message" => "template_name parameter is required."]);
        exit();
    }

    $template_name = $_GET['template_name'];

    // Retrieve template data
    $templateQuery = "SELECT template_id, template_name, template_icon FROM template WHERE template_name = ?";
    $stmt = $conn->prepare($templateQuery);
    $stmt->bind_param("s", $template_name);
    $stmt->execute();
    $templateResult = $stmt->get_result();

    if ($templateResult->num_rows === 0) {
        http_response_code(400);
        echo json_encode(["message" => "Template not found."]);
        exit();
    }

    $templateRow = $templateResult->fetch_assoc();
    $template = [
        "template_id" => $templateRow["template_id"],
        "template_name" => $templateRow["template_name"],
        "template_icon" => $templateRow["template_icon"],
        "fields" => []
    ];

    // Retrieve fields related to the template
    $fieldsQuery = "SELECT f.title, f.name, f.placeholder, fit.is_required
                    FROM field f
                    JOIN fields_in_template fit ON fit.field_id = f.field_id
                    WHERE fit.template_id = ?";
    $stmt = $conn->prepare($fieldsQuery);
    $stmt->bind_param("i", $templateRow["template_id"]);
    $stmt->execute();
    $fieldsResult = $stmt->get_result();

    while ($fieldRow = $fieldsResult->fetch_assoc()) {
        $template["fields"][] = [
            "title" => $fieldRow["title"],
            "name" => $fieldRow["name"],
            "placeholder" => $fieldRow["placeholder"],
            "is_required" => $fieldRow["is_required"]
        ];
    }

    // Prepare the response
    $response = [
        "template" => $template
    ];

    // Return the response
    http_response_code(200);
    echo json_encode($response);

    // Close the database connection
    $stmt->close();
    $conn->close();
?>
