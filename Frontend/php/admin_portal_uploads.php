<?php include 'head.php'; ?>

<!-- Hide old toast messages -->
<style>
    .toast.fade.hide {
        display: none !important;
    }
</style>

<body id="page-top">

    <!-- Toast message -->
    <div id="toastMsgContainer" aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container p-3" style="position: absolute; top: 80px; right: 10px;">
            <div id="successToastMessage" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
                style="display: none">
                <div class="toast-header">
                    <i class="bi bi-check-circle-fill primary-green-darker fs-3 pe-2"></i>
                    <strong class="primary-green-darker fs-6 me-auto">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body"></div>
            </div>
        </div>
    </div>

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
                        <h1 class="h3 primary-red mb-0">Uploads</h1>
                    </div>
                </div>

                <!-- Page content -->
                <div class="row mx-0">

                    <!-- Tab menu -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="published-tab" data-bs-toggle="tab"
                                data-bs-target="#published-tab-pane" type="button" role="tab"
                                aria-controls="published-tab-pane" aria-selected="true">Pending for Approval</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="archived-tab" data-bs-toggle="tab"
                                data-bs-target="#archived-tab-pane" type="button" role="tab"
                                aria-controls="archived-tab-pane" aria-selected="false">Archived</button>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content px-0" id="myTabContent">
                        <div id="tab-panel">
                            <table class="table table-striped table-hover">
                                <tbody id="tab-panel-tbody"></tbody>
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

            // Retrieve the query parameter from the URL
            const urlParams = new URLSearchParams(window.location.search);
            const publishSuccessParam = urlParams.get('publishsuccess');
            const moveToArchiveSuccessParam = urlParams.get('movetoarchivesuccess');

            if (publishSuccessParam === 'true') {
                // If the success parameter is present and set to 'true', show the success toast message
                var successToastMessage = document.getElementById('successToastMessage');
                var toast = new bootstrap.Toast(successToastMessage);
                successToastMessage.style.display = 'block';
                var toastBody = document.querySelector('.toast-body')
                toastBody.textContent = "Upload has been published successfully.";
                toast.show();
            } else {
                if (moveToArchiveSuccessParam === 'true') {
                    // If the move to archive success parameter is present and set to 'true', show the move to archive success toast message
                    var successToastMessage = document.getElementById('successToastMessage');
                    var toast = new bootstrap.Toast(successToastMessage);
                    successToastMessage.style.display = 'block';
                    var toastBody = document.querySelector('.toast-body');
                    toastBody.textContent = "Upload has been moved to archive.";
                    toast.show();
                }
            }
        });

        // Pending for approval uploads listing
        function loadPublishedData() {
            $.ajax({
                url: 'getUploads.php',
                method: 'GET',
                success: function (response) {
                    // Handle the AJAX success response
                    console.log("published: " + response);

                    // Clear the existing content of tab body
                    $('#tab-panel-tbody').empty();

                    // Sort the uploads based on formattedDateTime in descending order
                    response.uploads.sort(function (a, b) {
                        var dateA = new Date(a.updated);
                        var dateB = new Date(b.updated);
                        return dateB - dateA;
                    });

                    // Loop through the uploads in the response
                    response.uploads.forEach(function (upload) {

                        // Format updated date time format
                        var updatedElement = new Date(upload.updated);
                        // Format the date
                        var formattedDate = updatedElement.toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        // Format the time
                        var formattedTime = updatedElement.toLocaleString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });
                        var formattedDateTime = formattedDate + ' ' + formattedTime;

                        // Create a new row element for published items
                        if (upload.upload_status == 1) {
                            var newRow = $('<tr></tr>');
                            var rowContent = '';
                            rowContent += '<th scope="row" width="40%">';
                            rowContent += '<p class="recordFileName mb-0">' + upload.title + '</p>';
                            rowContent += '<p class="recordCategory mb-0">' + upload.template_name + '</p>';
                            rowContent += '</th>';

                            rowContent += '<td>';
                            rowContent += '<span>' + formattedDateTime + '</span > ';
                            rowContent += '</td>';

                            rowContent += '<td scope="row">';
                            rowContent += '<p class="mb-0">' + upload.first_name + ' ' + upload.last_name + '</p>';
                            rowContent += '<p class="mb-0">' + upload.email + '</p>';
                            rowContent += '</td>';

                            rowContent += '<td>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn me-lg-2" onclick="editUpload(' + upload.upload_id + ')"><i class="bi bi-pencil-fill pe-2"></i>Edit</button>';
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

        // Archived uploads listing
        function loadArchivedData() {
            $.ajax({
                url: 'getUploads.php',
                method: 'GET',
                success: function (response) {
                    // Handle the AJAX success response
                    console.log("published: " + response);

                    // Clear the existing content of tab body
                    $('#tab-panel-tbody').empty();

                    // Sort the uploads based on formattedDateTime in descending order
                    response.uploads.sort(function (a, b) {
                        var dateA = new Date(a.updated);
                        var dateB = new Date(b.updated);
                        return dateB - dateA;
                    });

                    // Loop through the uploads in the response
                    response.uploads.forEach(function (upload) {
                        // Format updated date time format
                        var updatedElement = new Date(upload.updated);
                        // Format the date
                        var formattedDate = updatedElement.toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        });
                        // Format the time
                        var formattedTime = updatedElement.toLocaleString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                        });
                        var formattedDateTime = formattedDate + ' ' + formattedTime;

                        // Create a new row element for published items
                        if (upload.upload_status == 3) {
                            var newRow = $('<tr></tr>');
                            var rowContent = '';
                            rowContent += '<th scope="row" width="40%">';
                            rowContent += '<p class="recordFileName mb-0">' + upload.title + '</p>';
                            rowContent += '<p class="recordCategory mb-0">' + upload.template_name + '</p>';
                            rowContent += '</th>';

                            rowContent += '<td>';
                            rowContent += '<span>Uploaded at ' + formattedDateTime + '</span>';
                            rowContent += '</td>';


                            rowContent += '<td scope="row">';
                            rowContent += '<p class="mb-0">' + upload.first_name + ' ' + upload.last_name + '</p>';
                            rowContent += '<p class="mb-0">' + upload.email + '</p>';
                            rowContent += '</td>';

                            rowContent += '<td>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn me-lg-2" onclick="editUpload(' + upload.upload_id + ')"><i class="bi bi-pencil-fill pe-2"></i>Edit</button>';
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

        function editUpload(upload_id) {
            console.log("edit: " + upload_id);
            window.location.href = "admin_portal_edit_upload.php?upload_id=" + upload_id;
        }

    </script>
</body>

</html>