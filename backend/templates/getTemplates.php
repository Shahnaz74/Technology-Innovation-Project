<?php

  require_once("databaseConfig.php");

  // Retrieve all templates and their fields
  $sql = "SELECT * FROM template";
  $result = $mysqli->query($sql);

  $templates = array();
  while ($row = $result->fetch_assoc()) {
    $template_id = $row['template_id'];
    $template_name = $row['template_name'];

    // Retrieve fields for this template
    $fields_sql = "SELECT * FROM fields WHERE template_id = $template_id";
    $fields_result = $mysqli->query($fields_sql);

    $fields = array();
    while ($field_row = $fields_result->fetch_assoc()) {
      $fields[] = $field_row;
    }

    $templates[] = array(
      "template_id" => $template_id,
      "template_name" => $template_name,
      "fields" => $fields
    );
  }

  // Return result as JSON
  header('Content-Type: application/json');
  echo json_encode($templates);

  // Close connection
  $mysqli->close();

?>
