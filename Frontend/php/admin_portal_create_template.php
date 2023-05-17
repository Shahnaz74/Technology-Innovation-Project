<?php
include 'head.php';
?>

<!-- Hide old toast messages -->
<style>
    .toast.fade.hide {
        display: none !important;
    }
</style>

<body id="page-top">

    <!-- Toast message -->
    <div id="toastMsgContainer" aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container p-3">
        </div>
    </div>

    <div class="wrapper">

        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <!-- Topnav -->
            <?php include 'admin_header.php' ?>

            <div class="container-fluid mb-5">

                <!-- Page header -->
                <header id="form-header" class="row mx-0 mb-4">
                    <div class="col-lg d-flex">
                        <h1 class="h3 primary-red">Add new Template</h1>
                    </div>
                    <div class="col-lg-auto">
                        <button type="button" id="saveTemplateButton" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Save Template</button>
                    </div>
                </header>

                <!-- Page content -->
                <div class="row mx-0">
                    <form class="needs-validation row" novalidate>

                        <!-- Template name -->
                        <div class="mb-4">
                            <label for="templateName" class="form-label">Template name <span class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="templateName" placeholder="" required>
                        </div>

                        <div class="templateFields">

                            <!-- Template field header -->
                            <div class="row align-items-center mx-0 px-0">
                                <div class="col-lg d-flex px-0">
                                    <p>Template fields</p>
                                </div>
                                <div class="col-lg-auto px-0">
                                    <button type="button" class="btn btn-outline-primary mb-4" id="addRow" class="add"><i class="bi bi-plus-lg pe-2"></i>
                                        Add data
                                        field
                                    </button>
                                </div>
                            </div>

                            <!-- Template field table -->
                            <div class="table-responsive">
                                <table id="templateFieldTable" class="table table-hover" data-toggle="table" data-mobile-responsive="true">
                                    <tbody id="tab-panel-tbody">
                                        <tr>
                                            <td td width="50%"><select class="form-select fieldDropdown" aria-label="Default select example">
                                                    <option selected>Select data field</option>
                                                    <option value="Contributor">Contributor</option>
                                                    <option value="Coverage">Coverage</option>'
                                                    <option value="Creator">Creator</option>
                                                    <option value="Date">Date</option>
                                                    <option value="Description">Description</option>
                                                    <option value="Format">Format</option>
                                                    <option value="Identifier">Identifier</option>
                                                    <option value="Language">Language</option>
                                                    <option value="Publisher">Publisher</option>
                                                    <option value="Relation">Relation</option>
                                                    <option value="Rights">Rights</option>
                                                    <option value="Source">Source</option>
                                                    <option value="Subject">Subject</option>
                                                    <option value="Title">Title</option>
                                                </select></td>

                                            <!-- Mandatory field -->
                                            <td><input class="form-check-input mt-0 me-2" type="checkbox" value="" id="flexCheckDefault">
                                                <label class="form-check-label">Mandatory field</label>
                                            </td>

                                            <!-- Delete button -->
                                            <td>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                // Get the buttons
                const deleteTemplateButton = document.getElementById('deleteTemplateButton');
                const saveTemplateButton = document.getElementById('saveTemplateButton');

                // Add click event listener to the save template button
                saveTemplateButton.addEventListener('click', function() {
                    // Form Validation
                    var validateStatus = validateForm();
                    // console.log("Validate status: " + validateStatus);
                    var fieldsArray = getFieldsArray();
                    var postData = {
                        template_name: document.getElementById("templateName")?.value || "",
                        fields: fieldsArray,
                        template_icon: null,
                    };

                    console.log(postData);

                    $.ajax({
                        url: 'createTemplate.php',
                        method: 'POST',
                        data: postData,
                        success: function(response) {
                            // Handle the AJAX success response
                            console.log(response);

                            // Check if the message matches a specific value
                            if (response.message === "Template has been created successfully") {
                                window.location.href = "admin_portal_templates.php?createsuccess=true";
                            }
                        },
                        error: function(error) {
                            // Handle the AJAX error
                            console.log(error);
                        }
                    });
                });

                // Add field button
                $("#addRow").click(function() {
                    var row_count = $('#row_count').val();
                    row_count++;

                    var row = $('<tr></tr>');
                    var rowContent = '';
                    rowContent += '<td><select class="form-select fieldDropdown" aria-label="Default select example">';

                    // Get all the selected options from previous rows
                    var selectedOptions = [];
                    var previousRows = document.querySelectorAll('table tr');
                    previousRows.forEach(function(row) {
                        var selectedOption = row.querySelector('.fieldDropdown').value;
                        selectedOptions.push(selectedOption);
                    });

                    // Iterate through the remaining options and add them to the dropdown if not selected in previous rows
                    var availableOptions = [
                        'Contributor', 'Coverage', 'Creator', 'Date', 'Description',
                        'Format', 'Identifier', 'Language', 'Publisher',
                        'Relation', 'Rights', 'Source', 'Subject', 'Title'
                    ];

                    availableOptions.forEach(function(option) {
                        if (!selectedOptions.includes(option)) {
                            rowContent += `<option value="${option}">${option}</option>`;
                        }
                    });

                    rowContent += '</select></td>';

                    // Mandatory field
                    rowContent += '<td><input class="form-check-input mt-0 me-2" type="checkbox" value="" id="flexCheckDefault">';
                    rowContent += '<label class="form-check-label" >Mandatory field</label></td>';

                    // Delete button
                    rowContent += '<td><button type="button" class="btn btn-outline-danger"><i class="bi bi-trash3-fill pe-2"></i>Delete field</button></td>';

                    row.html(rowContent);
                    $("tbody").append(row);
                    $('#row_count').val(row_count);
                });

                // Delete field button
                $("#templateFieldTable").on("click", ".btn.btn-outline-danger", function() {
                    var row_count = $('#row_count').val();
                    row_count--;
                    $('#row_count').val(row_count);
                    $(this).closest("tr").remove();
                });

                // Add event listener to every new row that is added
                $("#templateFieldTable").on("change", "select", function() {
                    // Code to handle select change goes here...
                });

            });

            function createToast(message) {
                var toastContainer = document.querySelector('.toast-container');

                var toastElement = document.createElement('div');
                toastElement.classList.add('toast');
                toastElement.setAttribute('role', 'alert');
                toastElement.setAttribute('aria-live', 'assertive');
                toastElement.setAttribute('aria-atomic', 'true');

                var toastHeader = document.createElement('div');
                toastHeader.classList.add('toast-header');

                var icon = document.createElement('i');
                icon.classList.add('bi', 'bi-exclamation-triangle-fill', 'primary-red-darker', 'fs-3', 'pe-2');

                var strong = document.createElement('strong');
                strong.classList.add('primary-red-darker', 'fs-6', 'me-auto');
                strong.textContent = 'Warning';

                var closeButton = document.createElement('button');
                closeButton.type = 'button';
                closeButton.classList.add('btn-close');
                closeButton.setAttribute('data-bs-dismiss', 'toast');
                closeButton.setAttribute('aria-label', 'Close');

                var toastBody = document.createElement('div');
                toastBody.classList.add('toast-body');
                toastBody.textContent = message;

                toastHeader.appendChild(icon);
                toastHeader.appendChild(strong);
                toastHeader.appendChild(closeButton);

                toastElement.appendChild(toastHeader);
                toastElement.appendChild(toastBody);
                toastContainer.appendChild(toastElement);

                var toast = new bootstrap.Toast(toastElement);
                toastElement.style.display = 'block';
                toast.show();
            }

            // Validate form
            function validateForm() {
                var templateName = document.getElementById("templateName").value;
                var isValid = true;

                // Check if record name is empty
                if (templateName.trim() === "") {
                    createToast('Template name is required');
                    isValid = false;
                    console.log("invalid7");
                } else {
                    // Check if record name already exists
                    checkTemplateName(templateName);
                }

                // Get all fields
                var fieldsArray = [];
                var rows = document.querySelectorAll('table tr');
                rows.forEach(function(row) {
                    // Check if option is selected
                    var templateField = row.querySelector('.form-select').value;

                    if (templateField === 'Select data field') {
                        createToast('Please choose a field')
                    } else {
                        var templateFieldRequired = row.querySelector('.form-check-input').checked ? 1 : 0;

                        var data = {
                            title: templateField,
                            is_required: templateFieldRequired
                        };

                        fieldsArray.push(data);
                    }
                });

                console.log(fieldsArray);

                // Return false if validation fails, true if it passes
                return fieldsArray.length > 0;
            }

            function checkTemplateName(templateName) {
                $.ajax({
                    url: 'getTemplates.php',
                    method: 'GET',
                    success: function(response) {
                        var templateExists = false; // Flag to track if the template name already exists

                        response.templates.forEach(function(template) {
                            if (template.template_name === templateName) {
                                templateExists = true;
                                isValid = false;
                                return false;
                            }
                        });

                        if (templateExists) {
                            createToast('This template name has been used. Enter new template name.');
                        } else {
                            console.log("Template name: " + templateName);
                        }
                    }
                })
            }

            // Get the fields array from the table rows
            function getFieldsArray() {
                var fieldsArray = [];
                var rows = document.querySelectorAll('table tr');
                rows.forEach(function(row) {
                    // Check if option is selected
                    var templateField = row.querySelector('.form-select').value;

                    if (templateField !== 'Select data field') {
                        var templateFieldRequired = row.querySelector('.form-check-input').checked ? 1 : 0;

                        var data = {
                            name: templateField,
                            is_required: templateFieldRequired
                        };

                        fieldsArray.push(data);
                    }
                });

                return fieldsArray;
            }
        </script>
</body>


</html>