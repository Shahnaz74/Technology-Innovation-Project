<?php
	require_once("databaseConfig.php");

	// Retrieve POST data
	$template_name = $_POST['template_name'];
	$field_name = $_POST['field_name'];
	$type = $_POST['type'];
	$title = $_POST['title'];
	$placeholder = $_POST['placeholder'];
	$is_required = $_POST['is_required'];

	// Insert new field
	$sql = "INSERT INTO fields (type, title, name, placeholder, is_required, template_id) VALUES ('$type', '$title', '$field_name', '$placeholder', '$is_required', (SELECT template_id FROM template WHERE template_name = '$template_name'))";

	if ($conn->query($sql) === TRUE) {
	  // Select all fields related to the specified template
	  $template_id = $conn->insert_id;
	  $sql = "SELECT * FROM fields WHERE template_id = $template_id";
	  $result = $conn->query($sql);

	  if ($result->num_rows > 0) {
	    $fields = array();
	    while($row = $result->fetch_assoc()) {
	      $fields[] = $row;
	    }
	    // Return JSON data
	    echo json_encode(array("data" => $fields));
	  } else {
	    echo "No fields found for template '$template_name'";
	  }
	} else {
	  echo "Error creating field: " . $conn->error;
	}

	// Close database connection
	$conn->close();
?>
