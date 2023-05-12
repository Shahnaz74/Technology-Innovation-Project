<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: index.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: index.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['user_name'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                header("Location: home.php");

                exit();

            }else{

                header("Location: index.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: index.php?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: index.php");

    exit();

}

// <?php 
//     select 
// ?>

Here we are fetching / getting the data from database and integrating it in our frontend 

Insert

Here we are inserting the input data in database 

Update

Here we will select the data from databse and do modification in the sected data and update it in database.

Delete

We will select / fetch the data according to user selection and delete relevant data from databse.

// Now, if you log in using the wrong credentials, you will get the following output

// /PHP_8

// Learn from the Best in the Industry!
// Caltech PGP Full Stack DevelopmentEXPLORE PROGRAMLearn from the Best in the Industry!
// Step 5 - Create a Logout Session
// In this section, you will create a "logout.php" file. 

// When a user selects the logout option, the code mentioned below will automatically redirect the user back to the login page.

// <?php 

// session_start();

// session_unset();

// session_destroy();

// header("Location: index.php");

// Step 6 - Create a Code for the Home Page
// Next, this tutorial will show you how to get back to the home page. 

// The code for the home page is:

// <?php 

// session_start();

// if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>

<!DOCTYPE html>

<html>

<head>

    <title>HOME</title>

    <link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

     <h1>Hello, <?php echo $_SESSION['name']; ?></h1>

     <a href="logout.php">Logout</a>

</body>

</html>

<?php 

// }else{

     header("Location: index.php");

     exit();

// }

 ?>

 <?php

 // Make a connection to your MySQL database
 $servername = "localhost";
 $username = "yourusername";
 $password = "yourpassword";
 $dbname = "yourdatabasename";
 
 $conn = new mysqli($servername, $username, $password, $dbname);
 
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 
 // Set up headers for CORS (Cross-Origin Resource Sharing)
 header("Access-Control-Allow-Origin: *");
 header("Access-Control-Allow-Methods: *");
 header("Access-Control-Allow-Headers: *");
 
 // Set up your API routes
 if ($_SERVER['REQUEST_METHOD'] == 'GET') {
     // Handle GET requests
     if ($_GET['action'] == 'get_users') {
         // Retrieve users from the database and return them as JSON
         $sql = "SELECT * FROM users";
         $result = $conn->query($sql);
 
         $users = array();
 
         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 $users[] = $row;
             }
         }
 
         header('Content-Type: application/json');
         echo json_encode($users);
     }
 } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
     // Handle POST requests
     if ($_POST['action'] == 'add_user') {
         // Add a new user to the database
         $name = $_POST['name'];
         $email = $_POST['email'];
 
         $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
 
         if ($conn->query($sql) === TRUE) {
             echo "New user added successfully";
         } else {
             echo "Error: " . $sql . "<br>" . $conn->error;
         }
     }
 }
 
 // Close the database connection
 $conn->close();
//  you'll need to create a PHP file that will handle incoming requests from your front-end or other client-side applications. Let's call this file api.php
//  In this example, we have set up two API routes: get_users and add_user.

// get_users: This route handles GET requests and retrieves all users from the users table in the database. It then returns the users as a JSON array.
// add_user: This route handles POST requests and adds a new user to the users table in the database. It expects the name and email parameters to be passed in the POST data.
// Note that this is just a simple example to get you started. In practice, you'll likely want to add more error handling and security measures to your API.

// Also, keep in mind that this example uses the mysqli extension, which is not the recommended way to interact with MySQL databases in modern PHP applications. You may want to consider using an ORM or a database abstraction layer like PDO instead.

// Set up headers for CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");

// These lines set up the headers necessary to allow cross-origin resource sharing. This is required if you plan on making API requests from a different domain or server than the one hosting your API. The * wildcard allows requests from any origin, but in practice you may want to restrict this to specific domains.

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Handle GET requests
    if ($_GET['action'] == 'get_users') {
        // Retrieve users from the database and return them as JSON
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        $users = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($users);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle POST requests
    if ($_POST['action'] == 'add_user') {
        // Add a new user to the database
        $name = $_POST['name'];
        $email = $_POST['email'];

        $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "New user added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
// This section is where the actual API functionality is implemented. We check the HTTP method of the request (GET or POST) and then check the action parameter in the request data to determine what action to take.

// If the method is GET and the action parameter is get_users, we retrieve all users from the users table in the database and return them as a JSON array.

// If the method is POST and the action parameter is add_user, we retrieve the name and email parameters from the request data and insert a new row into the users table with those values.


// Close the database connection
$conn->close();
// Finally, we close the database connection to free up resources. This is important to prevent performance issues or errors in the long run.

// As mentioned earlier, this is just a basic example to get started. In a real-world scenario, you would want to add more robust error handling, data validation, and security measures to your API to ensure that it's secure and reliable.