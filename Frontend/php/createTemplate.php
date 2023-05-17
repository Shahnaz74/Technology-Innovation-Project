<?php
header("Content-Type: application/json; charset=UTF-8");
require_once('databaseConfig.php');

// Read the request data
$request_data = file_get_contents('php://input');
$data = json_decode($request_data);

// Create the template record
$template_name = $data->template_name;
$template_icon = $data->template_icon;
$fields = $data->fields;
$sql = "INSERT INTO template (template_name, template_icon) VALUES ('$template_name', '$template_icon')";
if ($conn->query($sql) === FALSE) {
    http_response_code(400);
    die("Error: " . $sql . "<br>" . $conn->error);
}

// Get the template ID
$template_id = $conn->insert_id;

// Add the fields to the template
foreach ($fields as $field) {
    $field_name = $field->name;
    $is_required = $field->is_required;
    $sql = "SELECT * FROM field WHERE name='$field_name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $field_id = $row["field_id"];
        $sql = "INSERT INTO fields_in_template (is_required, template_id, field_id) VALUES ('$is_required', '$template_id', '$field_id')";
        if ($conn->query($sql) === FALSE) {
            http_response_code(400);
            die("Error: " . $sql . "<br>" . $conn->error);
        }
    }
}

// Get the created template data
$sql = "SELECT * FROM template WHERE template_id='$template_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $template_data = array(
        "template_name" => $row["template_name"],
        "template_icon" => $row["template_icon"],
        "fields" => array()
    );
    $sql = "SELECT * FROM fields_in_template WHERE template_id='$template_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $field_id = $row["field_id"];
            $sql = "SELECT * FROM field WHERE field_id='$field_id'";
            $field_result = $conn->query($sql);
            if ($field_result->num_rows > 0) {
                $field_row = $field_result->fetch_assoc();
                $field_data = array(
                    "name" => $field_row["name"],
                    "is_required" => $row["is_required"]
                );
                array_push($template_data["fields"], $field_data);
            }
        }
    }
}

// Return the response data
$response_data = array(
    "message" => "Template has been created successfully",
    "data" => $template_data
);
header('Content-Type: application/json');
echo json_encode($response_data);

// Close the database connection
$conn->close();
