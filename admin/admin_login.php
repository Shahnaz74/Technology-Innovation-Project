<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === 1){
    header("location: dashboard.php");
    exit;
}

include 'db.php'; 
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
}

if(isset($_POST['email']) && isset($_POST['password'])){


// Check if username is empty
if(empty(trim($_POST["email"]))){
    $email_err = "Please enter your email.";
} else{
    $email = trim($_POST["email"]);
}

// Check if password is empty
if(empty(trim($_POST["password"]))){
    $password_err = "Please enter your password.";
} else{
    $password = trim($_POST["password"]);
}

// Validate credentials
if(empty($email_err) && empty($password_err)){
    $generated = md5($password);
    $sql = "SELECT * FROM admin_user WHERE email='$email' AND password='$generated'";

        $result = mysqli_query($conn, $sql);
        // echo mysqli_num_rows($result);die;
        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);
            // print_r($row);die;


            if ($row['email'] === $email && $row['password'] === $generated) {

                // echo "Logged in!";

                $_SESSION['email'] = $row['email'];

                $_SESSION['name'] = $row['first_name'].' '.$row['last_name'];

                $_SESSION['id'] = $row['id'];

                $_SESSION['loggedin'] = 1;

                header("Location: dashboard.php");

                exit();

            }else{
                // die('1234');

                header("Location: admin_login.php?error=Incorect Email or Password");

                exit();

            }

        }else{

                header("Location: admin_login.php?error=Incorect Email or Password");

                exit();

        }
}
}


?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Login</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;1,400;1,700&family=Roboto:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.4.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/custom-css.css">

    <!-- Bootstrap JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>

    <!-- Custom JS -->
    <script defer src="../js/custom-js.js"></script>
</head>

<body>
    <section class="d-flex flex-column justify-content-center align-items-center h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 d-flex flex-column align-items-center">
                    <div class="mb-5 d-flex align-items-center">
                        <img class="mb-0" src="../img/rcca-logo.png" alt="">
                    </div>
                    <?php //print_r($_GET); ?>
                    <span class="text-danger"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></span>
                    <form class="w-100 d-flex flex-column" method="POST" action="">
                            
                    <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label sans">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-5">
                            <label for="exampleInputPassword1" class="form-label sans">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mx-auto">
                            <button type="submit" name="submit" class="btn btn-primary btn-block sans">Login</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'script.php' ?>
</body>

</html>