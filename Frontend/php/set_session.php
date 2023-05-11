<?php
// Start the session
session_start();

// Retrieve the JSON response from the AJAX request
$jsonResponse = $_POST['response'];
$provided_keyword = $_POST['provided_keyword'];
$filteredResponse = $_POST['filteredResponse'];

// Store the JSON response in a session variable
$_SESSION['jsonString'] = $jsonResponse;
$_SESSION['provided_keyword'] = $provided_keyword;
$_SESSION['filteredResponse'] = $filteredResponse;
?>
