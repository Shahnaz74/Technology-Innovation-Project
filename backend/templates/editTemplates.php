<?php
    require_once("databaseConfig.php");

    // Get the template name from the URL parameter
    $template_name = $_GET['template_name'];

    // Get the request body as JSON and decode it into an associative array
    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true);


    // Prepare and execute the query to update the template
    $stmt = $mysqli->prepare("UPDATE template SET template_icon = ? WHERE template_name = ?");
    $stmt->bind_param('ss', $data['template_icon'], $template_name);
    $result = $stmt->execute();

    // If the query was successful, update the fields for the template
    if ($result) {
      // Get the template ID
      $stmt = $mysqli->prepare("SELECT template_id FROM template WHERE template_name = ?");
      $stmt->bind_param('s', $template_name);
      $stmt->execute();
      $result = $stmt->get_result();
      $template_id = $result->fetch_assoc()['template_id'];

      // Delete all the fields for the template
      $stmt = $mysqli->prepare("DELETE FROM fields WHERE template_id = ?");
      $stmt->bind_param('i', $template_id);
      $stmt->execute();

      // Insert the new fields for the template
      $fields = $data['fields'];
      foreach ($fields as $field) {
        $stmt = $mysqli->prepare("INSERT INTO fields (type, title, name, placeholder, is_required, template_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('ssssii', $field['type'], $field['title'], $field['name'], $field['placeholder'], $field['is_required'], $template_id);
        $stmt->execute();
      }

      // Prepare the response JSON
      $response = array(
        'message' => 'Template updated successfully',
        'template' => array(
          'template_name' => $template_name,
          'template_icon' => $data['template_icon'],
          'fields' => $fields
        )
      );
    } else {
      // If the query failed, prepare the response JSON with an error message
      $response = array(
        'message' => 'Failed to update template',
        'template' => null
      );
    }

    // Send the response JSON
    header('Content-Type: application/json');
    echo json_encode($response);

?>

//request body:
{
  "template_icon": "path/to/template_icon.png",
  "fields": [
    {
      "type": "text",
      "title": "First Name",
      "name": "first_name",
      "placeholder": "Enter your first name",
      "is_required": true
    },
    {
      "type": "text",
      "title": "Last Name",
      "name": "last_name",
      "placeholder": "Enter your last name",
      "is_required": true
    },
    {
      "type": "email",
      "title": "Email Address",
      "name": "email",
      "placeholder": "Enter your email address",
      "is_required": true
    }
  ]
}
