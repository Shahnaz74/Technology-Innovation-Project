<?php

  require_once('../databaseConfig.php');
        
  // Check if the request method is DELETE
  if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    
      // Check if the template_name parameter is set
      if (isset($_GET["template_name"])) {
          
          $template_name = $_GET["template_name"];
          // Get the template_id of the template to be deleted
          $sql = "SELECT template_id FROM template WHERE template_name = '$template_name'";
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $template_id = $row["template_id"];
          } else {
              // Return error message if template_name does not exist
              http_response_code(400);
              echo "Error: Template not found.";
              exit();
          }
          
          // Delete all related fields from the fields_in_template table
          $sql = "DELETE FROM fields_in_template WHERE template_id = $template_id";
          if ($conn->query($sql) !== TRUE) {
              // Return error message if deletion from fields_in_template table fails
              http_response_code(400);
              echo "Error: " . $conn->error;
              exit();
          }
          
          // Delete the template from the template table
          $sql = "DELETE FROM template WHERE template_id = $template_id";
          if ($conn->query($sql) !== TRUE) {
              // Return error message if deletion from template table fails
              http_response_code(400);
              echo "Error: " . $conn->error;
              exit();
          }
          
          
          
          // Return success message
          http_response_code(200);
          echo "Template removed successfully.";
          exit();
          
      } else {
          // Return error message if template_name parameter is not set
          http_response_code(400);
          echo "Error: Template name is required.";
          exit();
      }
    
  }

  // Close database connection
  $conn->close();

?>
