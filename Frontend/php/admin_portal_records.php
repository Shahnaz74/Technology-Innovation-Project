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
            <div id="successToastMessage" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="display: none">
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
                        <h1 class="h3 primary-red mb-0">Records</h1>
                        <form class="form-inline ms-4">
                            <div class="input-group">
                                <input class="form-control" id="searchInput" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="bi bi-search pe-2"></i>Search</button>
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
                            <button class="nav-link active" id="published-tab" data-bs-toggle="tab" data-bs-target="#published-tab-pane" type="button" role="tab" aria-controls="published-tab-pane" aria-selected="true">Published</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived-tab-pane" type="button" role="tab" aria-controls="archived-tab-pane" aria-selected="false">Archived</button>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content px-0" id="myTabContent">
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
        $(document).ready(function() {
            // Get the search button
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('btnNavbarSearch');

            // Add click event listener to the search button
            searchButton.addEventListener('click', function() {
                // Handle click logic for the search
                console.log('Search clicked');
                searchRecords();
            });

            // Get the tab buttons
            const publishedTabButton = document.getElementById('published-tab');
            const archivedTabButton = document.getElementById('archived-tab');

            loadPublishedData();

            // Add click event listener to the Published tab button
            publishedTabButton.addEventListener('click', function() {
                // Handle click logic for the Published tab
                console.log('Published tab clicked');
                loadPublishedData();
            });

            // Add click event listener to the Archived tab button
            archivedTabButton.addEventListener('click', function() {
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
                toastBody.textContent = "Record has been published successfully.";
                toast.show();
            } else {
                if (moveToArchiveSuccessParam === 'true') {
                    // If the move to archive success parameter is present and set to 'true', show the move to archive success toast message
                    var successToastMessage = document.getElementById('successToastMessage');
                    var toast = new bootstrap.Toast(successToastMessage);
                    successToastMessage.style.display = 'block';
                    var toastBody = document.querySelector('.toast-body');
                    toastBody.textContent = "Record has been moved to archive.";
                    toast.show();
                }
            }
        });

        function searchRecords() {
            // Get the search input value
            var searchInput = document.getElementById("searchInput");
            var keyword = searchInput.value.toLowerCase();

            // Get all the rows in the table
            var rows = document.getElementById("tab-panel-tbody").getElementsByTagName("tr");

            // Loop through each row and hide/show based on the keyword
            for (var i = 0; i < rows.length; i++) {
                var rowData = rows[i].querySelector(".recordFileName").textContent.toLowerCase();

                if (rowData.indexOf(keyword) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Clear the search input field
            searchInput.value = "";
        }


        function loadPublishedData() {
            $.ajax({
                url: 'getUploads.php',
                method: 'GET',
                success: function(response) {
                    // Handle the AJAX success response
                    console.log("published: " + response);

                    // Clear the existing content of tab body
                    $('#tab-panel-tbody').empty();

                    // Sort the records based on formattedDateTime in descending order
                    response.uploads.sort(function(a, b) {
                        var dateA = new Date(a.updated);
                        var dateB = new Date(b.updated);
                        return dateB - dateA;
                    });

                    // Loop through the uploads in the response
                    response.uploads.forEach(function(upload) {
                        // Create a new row element for published items
                        if (upload.upload_status == 2) {
                            var newRow = $('<tr></tr>');
                            var rowContent = '';
                            rowContent += '<th scope="row" width="70%">';
                            rowContent += '<p class="recordFileName mb-0">' + upload.title + '</p>';
                            rowContent += '<p class="recordCategory mb-0">' + upload.template_name + '</p>';
                            rowContent += '</th>';
                            rowContent += '<td>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn me-lg-2" onclick="editUpload(' + upload.upload_id + ')"><i class="bi bi-pencil-fill pe-2"></i>Edit</button>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn delete-upload-btn" data-upload-id="' + upload.upload_id + '" onclick="deleteUpload(\'published\',' + upload.upload_id + ')"><i class="bi bi-trash3-fill pe-2"></i>Delete</button>';
                            rowContent += '</td>';
                            newRow.html(rowContent);
                            $('#tab-panel-tbody').append(newRow);
                        }
                    });
                },
                error: function(error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });
        }

        function loadArchivedData() {
            $.ajax({
                url: 'getUploads.php',
                method: 'GET',
                success: function(response) {
                    // Handle the AJAX success response
                    console.log("archived: " + response);

                    // Clear the existing content of tab body
                    $('#tab-panel-tbody').empty();

                    // Sort the records based on formattedDateTime in descending order
                    response.uploads.sort(function(a, b) {
                        var dateA = new Date(a.updated);
                        var dateB = new Date(b.updated);
                        return dateB - dateA;
                    });

                    // Loop through the uploads in the response
                    response.uploads.forEach(function(upload) {
                        // Create a new row element for archived items
                        if (upload.upload_status == 3) {
                            var newRow = $('<tr></tr>');
                            var rowContent = '';
                            rowContent += '<th scope="row" width="70%">';
                            rowContent += '<p class="recordFileName mb-0">' + upload.title + '</p>';
                            rowContent += '<p class="recordCategory mb-0">' + upload.template_name + '</p>';
                            rowContent += '</th>';
                            rowContent += '<td>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn me-lg-2" onclick="editUpload(' + upload.upload_id + ')"><i class="bi bi-pencil-fill pe-2"></i>Edit</button>';
                            rowContent += '<button type="button" class="btn neutral-outlin-btn me-lg-2" data-upload-id="' + upload.upload_id + '" onclick="deleteUpload(\'archived\',' + upload.upload_id + ')"><i class="bi bi-trash3-fill pe-2"></i>Delete</button>';
                            rowContent += '</td>';
                            newRow.html(rowContent);
                            $('#tab-panel-tbody').append(newRow);
                        }
                    });
                },
                error: function(error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });
        }

        function editUpload(upload_id) {
            console.log("edit: " + upload_id);
            window.location.href = "admin_portal_edit_record.php?upload_id=" + upload_id;
        }

        function deleteUpload(status, upload_id) {
            console.log("delete: " + upload_id);

            $.ajax({
                url: 'removeUpload.php',
                method: 'GET',
                data: {
                    upload_id: upload_id
                },
                success: function(response) {
                    // Handle the AJAX success response
                    console.log("deleted " + status + ": " + response);

                    // Parse the JSON response
                    var jsonResponse = JSON.parse(response);

                    // Check if the message matches a specific value
                    if (jsonResponse.message === "Upload deleted successfully.") {
                        // Code to execute when the message matches
                        console.log("Upload deleted successfully.");
                        // reload the data
                        if (status === "published") {
                            loadPublishedData();
                        } else if (status === "archived") {
                            loadArchivedData();
                        }
                        showDeleteSuccessPopup();
                    } else {
                        // Code to execute when the message does not match
                        console.log("Unexpected response: " + response);
                    }

                },
                error: function(error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });
        }

        function showDeleteSuccessPopup() {
            var successToastMessage = document.getElementById('successToastMessage');

            var toastBody = document.querySelector('.toast-body');
            toastBody.textContent = "Record deleted successfully";

            var toast = new bootstrap.Toast(successToastMessage);
            successToastMessage.style.display = 'block';
            toast.show();
        }
    </script>
</body>


</html>