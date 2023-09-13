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
                        <h1 class="h3 primary-red mb-0">Templates</h1>
                    </div>
                    <div class="col-lg-auto">
                        <a href="admin_portal_create_template.php">
                            <button type="button" class="btn btn-primary"><i class="bi bi-plus-lg pe-2"></i></i>Add New
                                Template</button></a>
                    </div>
                </div>
                <!-- Page content -->
                <div class="row mx-0">

                    <table class="table table-striped table-hover">
                        <tbody id="tab-panel-tbody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            loadTemplateData();

            // Retrieve the query parameter from the URL
            const urlParams = new URLSearchParams(window.location.search);
            const createSuccessParam = urlParams.get('createsuccess');
            const updateSuccessParam = urlParams.get('updatesuccess');
            const deleteSuccessParam = urlParams.get('deletesuccess');



            if (createSuccessParam === 'true') {
                var successToastMessage = document.getElementById('successToastMessage');
                var toast = new bootstrap.Toast(successToastMessage);
                successToastMessage.style.display = 'block';
                var toastBody = document.querySelector('.toast-body');
                toastBody.textContent = "Template created successfully.";
                toast.show();
            }

            if (updateSuccessParam === 'true') {
                var successToastMessage = document.getElementById('successToastMessage');
                var toast = new bootstrap.Toast(successToastMessage);
                successToastMessage.style.display = 'block';
                var toastBody = document.querySelector('.toast-body');
                toastBody.textContent = "Template has been updated successfully.";
                toast.show();
            }

            if (deleteSuccessParam === 'true') {
                var successToastMessage = document.getElementById('successToastMessage');
                var toast = new bootstrap.Toast(successToastMessage);
                successToastMessage.style.display = 'block';
                var toastBody = document.querySelector('.toast-body');
                toastBody.textContent = "Template deleted successfully.";
                toast.show();
            }
        })

        function loadTemplateData() {
            $.ajax({
                url: 'getTemplates.php',
                method: 'GET',
                success: function(response) {
                    // Handle the AJAX success response
                    console.log("Templates: " + response);

                    // Clear the existing content body
                    $('#tab-panel-tbody').empty();

                    // Loop through the uploads in the response
                    response.templates.forEach(function(template) {
                        // Create a new row element for published items
                        var newRow = $('<tr class="align-middle"></tr>');
                        var rowContent = '';
                        rowContent += '<th scope="row" width="60%">';
                        rowContent += '<p class="recordFileName mb-0"><img src="../img/recordCat_advertisment.svg" alt="Custom SVG" class="pe-1"> ' + template.template_name + '</p>';
                        rowContent += '</th>';

                        rowContent += '<td>';
                        rowContent += '<button type="button" class="btn neutral-outlin-btn me-lg-2" onclick="editTemplate(\'' + template.template_name + '\')"><i class="bi bi-pencil-fill pe-2"></i>Edit</button>';
                        rowContent += '</td>';

                        rowContent += '<td>';
                        rowContent += '<button type="button" class="btn neutral-outlin-btn delete-upload-btn" data-upload-id="' + template.template_name + '" onclick="deleteTemplate(\'published\',' + template.template_name + ')"><i class="bi bi-trash3-fill pe-2"></i>Delete</button>';
                        rowContent += '</td>';

                        newRow.html(rowContent);
                        $('#tab-panel-tbody').append(newRow);
                    });

                },
                error: function(error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });
        }

        function editTemplate(template_name) {
            console.log("edit: " + template_name);
            window.location.href = "admin_portal_edit_template.php?template_name=" + template_name;
        }

        function deleteTemplate(status, template_name) {
            console.log("delete: " + template_name);

            $.ajax({
                url: 'removeTemplate.php',
                method: 'GET',
                data: {
                    template_name: template_name
                },
                success: function(response) {
                    // Handle the AJAX success response
                    console.log("deleted " + status + ": " + response);
                    loadTemplateData();
                    showDeleteSuccessPopup();
                },
                error: function(error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });
        }

        function validateTemplate() {
            // Get all fields including newly created fields

        }

        function showDeleteSuccessPopup() {
            var successToastMessage = document.getElementById('successToastMessage');

            var toastBody = document.querySelector('.toast-body');
            toastBody.textContent = "Template deleted successfully";

            var toast = new bootstrap.Toast(successToastMessage);
            successToastMessage.style.display = 'block';
            toast.show();
        }
    </script>
</body>

</html>