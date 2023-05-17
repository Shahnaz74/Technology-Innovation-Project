<?php
  require_once('databaseConfig.php');

  // Check if the request method is PUT
  if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get the request body
    $data = json_decode(file_get_contents("php://input"));

    // Get the template name from the request body
    $template_name = $data->template_name;

    // Get the template icon from the request body
    $template_icon = $data->template_icon;

    // Get the fields from the request body
    $fields = $data->fields;

    // Start a database transaction
    mysqli_begin_transaction($conn);

    try {
      // Update the template
      $sql = "UPDATE template SET template_icon = '$template_icon', updated = NOW() WHERE template_name = '$template_name'";
      $result = mysqli_query($conn, $sql);

      // Delete all existing fields for this template
      $sql = "DELETE FROM fields_in_template WHERE template_id = (SELECT template_id FROM template WHERE template_name = '$template_name')";
      $result = mysqli_query($conn, $sql);

      // Add the new fields for this template
      foreach ($fields as $field) {
        // Get the field name from the request body
        $field_name = $field->name;

        // Get the is_required flag from the request body
        $is_required = $field->is_required;

        // Get the field ID
        $sql = "SELECT field_id FROM field WHERE name = '$field_name'";
        $result = mysqli_query($conn, $sql);
        $field_id = mysqli_fetch_assoc($result)['field_id'];

        // Add the field to the fields_in_template table
        $sql = "INSERT INTO fields_in_template (is_required, template_id, field_id) VALUES ('$is_required', (SELECT template_id FROM template WHERE template_name = '$template_name'), '$field_id')";
        $result = mysqli_query($conn, $sql);
      }

      // Commit the transaction
      mysqli_commit($conn);

      // Return a success message and the updated data
      $response = array(
        "message" => "Template has been updated",
        "data" => array(
          "template_name" => $template_name,
          "template_icon" => $template_icon,
          "fields" => $fields
        )
      );
      http_response_code(200);
      header('Content-Type: application/json');
      echo json_encode($response);
    } catch (Exception $e) {
      // Roll back the transaction on error
      mysqli_rollback($conn);

      // Return an error message
      $response = array("message" => "An error occurred that prevented the page from loading.");
      http_response_code(400);
      header('Content-Type: application/json');
      echo json_encode($response);
    }
  }

  // Close database connection
  mysqli_close($conn);
