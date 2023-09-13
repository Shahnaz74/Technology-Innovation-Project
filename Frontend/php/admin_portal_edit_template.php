<?php
include 'head.php';

$template_name = $_GET['template_name'];
echo "<script>console.log('template_name: " . $template_name . "');</script>";
echo "<script>var template_name = '" . $template_name . "';</script>";

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
                        <h1 class="h3 primary-red">Edit Template</h1>
                    </div>
                    <div class="col-lg-auto">
                        <button type="button" id="deleteTemplateButton" class="btn btn-outline-primary me-2"><i class="bi bi-trash3-fill pe-2 "></i>Delete Template</button>
                        <button type="button" id="saveTemplateButton" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Save Template</button>
                    </div>
                </header>

                <!-- Page content -->
                <div class="row mx-0">
                    <form class="needs-validation row" novalidate>

                        <!-- Template name -->
                        <div class="mb-4">
                            <label for="templateName" class="form-label">Template name <span class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="templateName" placeholder="" disabled>
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
                // Get template_name
                var templateName = "<?php echo $template_name; ?>";

                // Get template detail by name
                getTemplateDetail(templateName);

                // Get the buttons
                const deleteTemplateButton = document.getElementById('deleteTemplateButton');
                const saveTemplateButton = document.getElementById('saveTemplateButton');

                // Add click event listener to the delete template button
                deleteTemplateButton.addEventListener('click', function() {

                    $.ajax({
                        url: 'removeTemplate.php',
                        method: 'GET',
                        data: {
                            template_name: template_name
                        },
                        success: function(response) {
                            // Handle the AJAX success response
                            console.log("deleted: " + response);
                            window.location.href = "admin_portal_templates.php?deletesuccess=true";
                        },
                        error: function(error) {
                            // Handle the AJAX error
                            console.log(error);
                        }
                    });
                });

                // Add click event listener to the save template button
                saveTemplateButton.addEventListener('click', function() {
                    // Form Validation
                    var validateStatus = validateForm();
                    console.log(validateStatus);

                    if (validateStatus) {
                        var fieldsArray = getFieldsArray();
                        var postData = {
                            template_name: document.getElementById("templateName")?.value || "",
                            fields: fieldsArray,
                            template_icon: null,
                        };

                        console.log(postData);

                        $.ajax({
                            url: 'editTemplates.php',
                            method: 'PUT',
                            data: postData,
                            success: function(response) {
                                // Handle the AJAX success response
                                console.log("postData:", postData);
                                console.log("response:", response);

                                // Parse the JSON response
                                var jsonResponse = JSON.parse(response);

                                if (jsonResponse.message === "Template has been updated") {
                                    window.location.href = "admin_portal_templates.php?updatesuccess=true";
                                } else {
                                    console.log("Unexpected response: " + response.message);
                                }
                            }
                        });
                    }
                });

                // Add field button
                $("#addRow").click(function() {
                    var row_count = $('#row_count').val();
                    row_count++;
                    var field_count = 'field' + row_count;

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
                    rowContent += '<label class="form-check-label" for="flexCheckDefault">Mandatory field</label></td>';

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

            // Get template details
            function getTemplateDetail(templateName) {
                $.ajax({
                    url: 'getTemplateById.php',
                    method: 'GET',
                    data: {
                        template_name: templateName
                    },
                    success: function(response) {
                        // Handle the AJAX success response
                        console.log(response);

                        var jsonResponse = JSON.parse(response);

                        var templateName = document.getElementById("templateName");
                        templateName.value = jsonResponse.template.template_name;

                        // All fields
                        var fields = jsonResponse.template.fields;
                        console.log(fields);

                        // Fields details
                        // var firstField = jsonResponse.template.fields[0];
                        // var title = firstField.title;
                        // console.log(title);

                        // Clear the existing content of tab body
                        $('#tab-panel-tbody').empty();

                        fields.forEach(function(field, index) {
                            var newRow = $('<tr></tr>');
                            var rowContent = '';

                            // Field drop down
                            rowContent += '<td width="50%"><select class="form-select fieldDropdown" aria-label="Default select example">';
                            rowContent += `<option value="${field.name}" ${field.name === field.name ? 'selected' : ''}>${field.title}</option>`;

                            rowContent += '<option value="contributor">Contributor</option>';
                            rowContent += '<option value="coverage">Coverage</option>';
                            rowContent += '<option value="creator">Creator</option>';
                            rowContent += '<option value="date">Date</option>';
                            rowContent += '<option value="description">Description</option>';
                            rowContent += '<option value="format">Format</option>';
                            rowContent += '<option value="identifier">Identifier</option>';
                            rowContent += '<option value="language">Language</option>';
                            rowContent += '<option value="publisher">Publisher</option>';
                            rowContent += '<option value="relation">Relation</option>';
                            rowContent += '<option value="rights">Rights</option>';
                            rowContent += '<option value="source">Source</option>';
                            rowContent += '<option value="subject">Subject</option>';
                            rowContent += '<option value="title">Title</option>';

                            rowContent += '</select></td>';
                            rowContent += '</th>';

                            // Mandatory field
                            rowContent += '<td><input class="form-check-input mt-0 me-2" type="checkbox" value="" id="flexCheckDefault"';
                            rowContent += field.is_required === 1 ? ' checked' : '';
                            rowContent += '>';
                            rowContent += '<label class="form-check-label">Mandatory field</label></td>';


                            // Delete button
                            if (index > 0) {
                                rowContent += '<td>';
                                rowContent += '<button type="button" class="btn btn-outline-danger"><i class="bi bi-trash3-fill pe-2"></i>Delete field</button>';
                                rowContent += '</td>';
                            } else {
                                rowContent += '<td></td>'; // Empty cell for the first row
                            }

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

            // Get the fields array from the table rows
            function getFieldsArray() {
                var fieldsArray = [];

                var rows = document.querySelectorAll('table tr');
                rows.forEach(function(row) {
                    // Check if option is selected
                    var templateField = row.querySelector('.form-select').value.toLowerCase();

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

            function checkDuplicateNames(fieldsArray) {
                var namesArray = fieldsArray.map(function(field) {
                    return field.name;
                });

                var duplicateNames = namesArray.filter(function(name, index) {
                    return namesArray.indexOf(name) !== index;
                });

                return duplicateNames;
            }

            // Validate form
            function validateForm() {
                var templateName = document.getElementById("templateName").value;
                var fieldsArray = getFieldsArray();
                var duplicateNames = checkDuplicateNames(fieldsArray);
                var isValid = true;

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

                if (duplicateNames.length > 0) {
                    createToast('There are duplicated fields');
                    isValid = false;
                    console.log("invalid7");
                }
                return isValid;
            }
        </script>
</body>


</html>