<?php

	require_once("databaseConfig.php");

	// Check if required fields are set
	if (!isset($_POST['template_name'], $_POST['field_name'], $_POST['is_required'])) {
	    http_response_code(400);
	    echo json_encode(array("message" => "Missing required fields"));
	    exit();
	}

	// Get the field ID from the field name
	$field_name = $_POST['field_name'];
	$sql = "SELECT field_id FROM field WHERE name='$field_name'";
	$result = $conn->query($sql);
	if ($result->num_rows == 0) {
	    http_response_code(400);
	    echo json_encode(array("message" => "Field not found"));
	    exit();
	}
	$field_id = $result->fetch_assoc()['field_id'];

	// Get the template ID from the template name
	$template_name = $_POST['template_name'];
	$sql = "SELECT template_id, template_icon FROM template WHERE template_name='$template_name'";
	$result = $conn->query($sql);
	if ($result->num_rows == 0) {
	    http_response_code(400);
	    echo json_encode(array("message" => "Template not found"));
	    exit();
	}
	$template_row = $result->fetch_assoc();
	$template_id = $template_row['template_id'];
	$template_icon = $template_row['template_icon'];

	// Insert the new field into the fields_in_template table
	$is_required = $_POST['is_required'] ? 1 : 0;
	$sql = "INSERT INTO fields_in_template (is_required, template_id, field_id) VALUES ($is_required, $template_id, $field_id)";
	if ($conn->query($sql) === TRUE) {
	    // Success, return the updated template data
	    $fields = array();
	    $sql = "SELECT f.name, fit.is_required FROM fields_in_template fit INNER JOIN field f ON fit.field_id=f.field_id WHERE fit.template_id=$template_id";
	    $result = $conn->query($sql);
	    while ($row = $result->fetch_assoc()) {
	        $field = array("name" => $row['name'], "is_required" => $row['is_required']);
	        $fields[] = $field;
	    }
	    $data = array("template_name" => $template_name, "template_icon" => $template_icon, "fields" => $fields);
	    echo json_encode(array("message" => "The field has been added successfully", "data" => $data));
	} else {
	    // Error
	    http_response_code(400);
	    echo json_encode(array("message" => "Error adding field to template"));
	}

	// Close the database connection
	$conn->close();

?>
