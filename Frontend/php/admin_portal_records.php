<?php include 'head.php'; ?>

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
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <!-- Topnav -->
            <?php include 'admin_header.php' ?>

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
                        <a href="admin_portal_submit_record.php">
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
                        <div id="tab-panel">
                            <table class="table table-striped table-hover">
                                <tbody id="tab-panel-tbody">

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            // Get the tab buttons
            const publishedTabButton = document.getElementById('published-tab');
            const archivedTabButton = document.getElementById('archived-tab');

            loadPublishedData();

            // Add click event listener to the Published tab button
            publishedTabButton.addEventListener('click', function () {
                // Handle click logic for the Published tab
                console.log('Published tab clicked');
                loadPublishedData();
            });

            // Add click event listener to the Archived tab button
            archivedTabButton.addEventListener('click', function () {
                // Handle click logic for the Archived tab
                console.log('Archived tab clicked');
                loadArchivedData();
            });

        });


        function loadPublishedData() {
            $.ajax({
                url: 'getUploads.php',
                method: 'GET',
                success: function (response) {
                    // Handle the AJAX success response
                    console.log("published: " + response);

                    // Clear the existing content of tab body
                    $('#tab-panel-tbody').empty();

                    // Loop through the uploads in the response
                    response.uploads.forEach(function (upload) {
                        // Create a new row element for published items
                        if (upload.upload_status == 2) {
                            var newRow = $('<tr></tr>');
                            var rowContent = '';
                            rowContent += '<th scope="row" width="80%">';
                            rowContent += '<p class="recordFileName mb-0">' + upload.title + '</p>';
                            rowContent += '<p>' + upload.template_name + '</p>';
                            rowContent += '</th>';
                            rowContent += '<td>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn me-lg-2" onclick="editUpload(' + upload.upload_id + ')"><i class="bi bi-pencil-fill pe-2"></i>Edit</button>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn delete-upload-btn" data-upload-id="' + upload.upload_id + '"><i class="bi bi-trash3-fill pe-2"></i>Delete</button>';
                            rowContent += '</td>';
                            newRow.html(rowContent);
                            $('#tab-panel-tbody').append(newRow);
                        }
                    });
                },
                error: function (error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });
        }

        function loadArchivedData() {
            $.ajax({
                url: 'getUploads.php',
                method: 'GET',
                success: function (response) {
                    // Handle the AJAX success response
                    console.log("archived: " + response);

                    // Clear the existing content of tab body
                    $('#tab-panel-tbody').empty();

                    // Loop through the uploads in the response
                    response.uploads.forEach(function (upload) {
                        // Create a new row element for published items
                        if (upload.upload_status == 3) {
                            var newRow = $('<tr></tr>');
                            var rowContent = '';
                            rowContent += '<th scope="row" width="80%">';
                            rowContent += '<p class="recordFileName mb-0">' + upload.title + '</p>';
                            rowContent += '<p>' + upload.template_name + '</p>';
                            rowContent += '</th>';
                            rowContent += '<td>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn me-lg-2" onclick="editUpload(' + upload.upload_id + ')"><i class="bi bi-pencil-fill pe-2"></i>Edit</button>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn delete-upload-btn" data-upload-id="' + upload.upload_id + '"><i class="bi bi-trash3-fill pe-2"></i>Delete</button>';
                            rowContent += '</td>';
                            newRow.html(rowContent);
                            $('#tab-panel-tbody').append(newRow);
                        }
                    });
                },
                error: function (error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });
        }
    </script>
</body>


</html>