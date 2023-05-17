<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Records</title>

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
</head>

<!-- Toast message -->
<div class="toast-container position-absolute bottom-0 end-0 p-3">
    <div class=" toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header">
            <i class="bi bi-check-circle-fill primary-green-darker pe-2"></i>
            <strong class="primary-green-darker me-auto">Record Added Successfully</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Regent Motors Advertisment has been to the digital archive.
        </div>
    </div>
</div>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="container text-center pb-4">
                <img class="img-fluid px-4 pb-2" src="../img/rcca-logo.png" alt="">
                <p class="primary-red serif">Admin Portal</p>
            </div>
            <ul class="list-group">
                <li class="list-group-item list-group-item-action sidebar-list-group-item active">
                    <a href="./admin_portal_records.html">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <i class="bi bi-file-earmark-text-fill me-2"></i>
                            <span>Records</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item list-group-item-action sidebar-list-group-item">
                    <a href="./admin_portal_uploads.html">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i>
                            <span>Uploads</span>
                        </div>
                    </a>
                </li>
                <li class="list-group-item list-group-item-action sidebar-list-group-item">
                    <a href="./admin_portal_templates.html">
                        <div class="d-flex w-100 justify-content-start align-items-center">
                            <i class="bi bi-grid-1x2-fill me-2"></i>
                            <span>Templates</span>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <!-- Topnav -->
            <nav class="navbar navbar-expand-lg border-bottom mb-5">
                <div class="container-fluid">

                    <!-- Sidebar toggle -->
                    <button type="button" id="sidebarCollapse" class="btn primary-neutal-800">
                        <i class="bi bi-list"></i>
                        <span>Toggle Menu</span>
                    </button>

                    <nav class="navbar navbar-expand">

                        <!-- Navbar-->
                        <ul class="navbar-nav ml-auto">

                            <!-- Top Navbar items - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="primary-neutal-800 mr-2">Admin Name</span>
                                    <img class="img-profile rounded-circle" src="../img/undraw_profile.svg"
                                        style="width: 32px; height: 32px;">
                                </a>

                                <!-- Top Navbar items Dropdown -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw primary-neutal-800 mr-2"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </nav>

            <div class="container-fluid">

                <!-- Page header -->
                <div class="row mx-0 mb-4">
                    <div class="col-lg d-flex px-0">
                        <h1 class="h3 primary-red mb-0">Records</h1>
                        <form class="form-inline ms-4">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Search for..."
                                    aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i
                                        class="bi bi-search pe-2"></i>Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-auto">
                        <a href="./admin_portal_submit_record.html">
                            <button type="button" class="btn btn-primary"><i class="bi bi-plus-lg pe-2"></i></i>Add New
                                Record</button></a>
                    </div>
                </div>

                <!-- Page content -->
                <div class="row mx-0">

                    <!-- Tab menu -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="published-tab" data-bs-toggle="tab"
                                data-bs-target="#published-tab-pane" type="button" role="tab"
                                aria-controls="published-tab-pane" aria-selected="true">Published</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="archived-tab" data-bs-toggle="tab"
                                data-bs-target="#archived-tab-pane" type="button" role="tab"
                                aria-controls="archived-tab-pane" aria-selected="false">Archived</button>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content px-0" id="myTabContent">

                        <!-- Published content -->
                        <div class="tab-pane fade show active" id="published-tab-pane" role="tabpanel"
                            aria-labelledby="published-tab" tabindex="0">
                            <table class="table table-striped table-hover">
                                <!-- Table header -->
                                <thead>
                                    <tr>
                                        <th scope="col">File name</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead> 
                                <!-- Record listing content -->
                                <tbody>
                                    <?php
                                    // Call getUpload.php script and get JSON response
                                    $response = file_get_contents('http://localhost/TIP/backend/uploads/getUploads.php');
                                    $data = json_decode($response, true);

                                    // Check if any uploads were found
                                    if (!empty($data['uploads'])) {
                                        // Loop through uploads and display each one
                                        foreach ($data['uploads'] as $upload) {
                                            // Check if upload_status is 2
                                            if ($upload['upload_status'] == 2) {
                                                echo '<tr>';
                                                echo '<th scope="row" width="60%">';
                                                echo '<p class="recordFileName mb-0">' . $upload['file_name'] . '</p>';
                                                echo '<p>' . $upload['template_name'] . '</p>';
                                                echo '</th>';
                                                echo '<td>'.$upload['first_name'].' '.$upload['last_name'].'</td>';
                                                echo '<td>';
                                                echo '<button type="button" class="btn neutral-outlin-btn me-lg-2" onclick="editUpload(' . $upload['upload_id'] . ')"><i class="bi bi-pencil-fill pe-2"></i>Edit</button>';
                                                echo '<button type="button" class="btn neutral-outlin-btn delete-upload-btn" data-upload-id="' . $upload['upload_id'] . '"><i class="bi bi-trash3-fill pe-2"></i>Delete</button>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    } else {
                                        // Display message if no uploads were found
                                        echo 'No uploads found.';
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                        <!-- Archive content -->
                        <div class="tab-pane fade" id="archived-tab-pane" role="tabpanel" aria-labelledby="archived-tab"
                            tabindex="0">
                            <table class="table table-striped table-hover">
                                <!-- Table header -->
                                <thead>
                                    <tr>
                                        <th scope="col">File name</th>
                                        <th scope="col">Author</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead> 
                                <!-- Record listing content -->
                                <tbody>
                                    <?php
                                    // Call getUpload.php script and get JSON response
                                    $response = file_get_contents('http://localhost/TIP/backend/uploads/getUploads.php');
                                    $data = json_decode($response, true);

                                    // Check if any uploads were found
                                    if (!empty($data['uploads'])) {
                                        // Loop through uploads and display each one
                                        foreach ($data['uploads'] as $upload) {
                                            // Check if upload_status is 3
                                            if ($upload['upload_status'] == 3) {
                                                echo '<tr>';
                                                echo '<th scope="row" width="60%">';
                                                echo '<p class="recordFileName mb-0">' . $upload['file_name'] . '</p>';
                                                echo '<p>' . $upload['template_name'] . '</p>';
                                                echo '</th>';
                                                echo '<td>'.$upload['first_name'].' '.$upload['last_name'].'</td>';
                                                echo '<td>';
                                                echo '<button type="button" class="btn neutral-outlin-btn me-lg-2" onclick="editUpload(' . $upload['upload_id'] . ')"><i class="bi bi-pencil-fill pe-2"></i>Edit</button>';
                                                echo '<button type="button" class="btn neutral-outlin-btn delete-upload-btn" data-upload-id="' . $upload['upload_id'] . '"><i class="bi bi-trash3-fill pe-2"></i>Delete</button>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }
                                    } else {
                                        // Display message if no uploads were found
                                        echo 'No uploads found.';
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>


    <script>
    //script for delete button
    document.addEventListener('DOMContentLoaded', () => {
      // Add event listener to delete upload buttons
      const deleteButtons = document.querySelectorAll('.delete-upload-btn');
      deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
          const uploadId = button.dataset.uploadId;
          deleteUpload(uploadId);
        });
      });

      // Function to delete an upload
      function deleteUpload(uploadId) {
        // Send a DELETE request to the removeUpload.php API
        fetch(`http://localhost/TIP/backend/uploads/removeUpload.php?upload_id=${uploadId}`, {
          method: 'DELETE'
        })
          .then(response => response.json())
          .then(data => {
            // Check if the deletion was successful
            if (data.message) {
              // Reload the page to reflect the updated upload list
              location.reload();
            } else {
              console.error('Failed to delete upload:', data);
            }
          })
          .catch(error => {
            console.error('Failed to delete upload:', error);
          });
      }
    });
    </script>

    <script>
    // Script to get upload by Id and pass the data to admin_portal_edit_record.php?data
    function editUpload(uploadId) {
        // Call getUploadById.php script and pass the upload_id parameter
        fetch('http://localhost/TIP/backend/uploads/getUploadById.php?upload_id=' + uploadId)
            .then(response => response.json())
            .then(data => {
                // Convert the upload data to a JSON string
                const uploadData = JSON.stringify(data.uploads[0]);
                
                // Encode the upload data for URL
                const encodedData = encodeURIComponent(uploadData);
                
                // Redirect to the admin_portal_edit_record.php page and pass the upload data as a parameter
                window.location.href = './admin_portal_edit_record.php?data=' + encodedData;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
</body>


</html>