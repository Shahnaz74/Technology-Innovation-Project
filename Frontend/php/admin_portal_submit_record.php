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
                        <h1 class="h3 primary-red">New Record</h1>
                    </div>
                    <div class="col-lg-auto">
                        <button type="button" id="saveToArchiveButton" class="btn btn-outline-primary me-2"><i class=" bi bi-archive-fill pe-2 "></i>Save to Archive</button>
                        <button type=" button" id="publishButton" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Publish</button>
                    </div>
                </header>

                <!-- Page content -->
                <div class="row mx-0">
                    <form class="needs-validation" novalidate>

                        <!-- Record name -->
                        <div class="mb-4">
                            <label for="recordName" class="form-label">Record name <span class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="recordName" placeholder="" required>
                            <div class="invalid-feedback">
                                Record name is required
                            </div>
                        </div>

                        <!-- Document type -->
                        <div class="col-md-6 mb-4">
                            <label for="documentType" class="form-label">Document type <span class="mandatoryField">*</span></label>
                            <select class="form-select" id="documentType" required onchange="generateForm()">
                                <option selected disabled value="">Choose...</option>
                                <!-- <option>Advertisement Journal</option>
                                <option>Advertisement Newspaper</option>
                                <option>Article Journal</option>
                                <option>Article Newspaper
                                </option>
                                <option>Book Historical
                                </option>
                                <option>Book Technical</option>
                                <option>Photograph Commercial
                                </option>
                                <option>Photograph Personal
                                </option>
                                <option>Sales Brochure
                                </option>
                                <option>Sales Record
                                </option> -->
                            </select>
                            <div class="invalid-feedback">
                                Please select document type.
                            </div>
                        </div>

                        <!-- File upload -->
                        <div class="fileUpload mb-4">
                            <label for="documentType" class="form-label">File upload <span class="mandatoryField">*</span></label>
                            <div id="uploadFileContainer">
                                <!-- Drag and drop file upload area -->
                                <div id="drop-area" class="col-md-6 col-md-offset-3 py-5">
                                    <img src="../img/fileUpload.svg" class="pb-2" alt="">
                                    <h5 id="drop-hint" class="serif pb-2">Drag & drop files or <a href="#" id="browse-btn">Browse</a></h5>
                                    <p id="drop-subhint">Supported formats: JPEG, PNG, PDF</p>
                                    <input type="file" id="file-input" accept=".jpg, .jpeg, .png, .pdf" style="display:none;">
                                    <p id="drop-subhint" class="primary-red">File size limit: 2MB</p>
                                    <!-- <div class="row" id="thumbnails"></div> -->
                                </div>

                                <!-- Uploaded file preview -->
                                <div id="uploaded-area">
                                    <div class="input-group mb-3">
                                        <input id="uploaded-file-name" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                        <button class="input-group-text deleteFileUpload" id="basic-addon2">
                                            <i class="bi bi-trash3-fill pe-2"></i>
                                            Delete file
                                        </button>
                                    </div>
                                    <div class="col-4" id="filePreview">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- File keyword -->
                        <div class="mb-4">
                            <label class="mb-2" for="subjectKeyword">Topic subject</label>
                            <span class="mandatoryField">*</span></label>
                            <div>
                                <select id="subjectKeyword" name="subjectKeyword[]" multiple>
                                </select>
                            </div>

                        </div>

                        <!-- Form fields -->
                        <div id="container"> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Get the buttons
            const archiveButton = document.getElementById('saveToArchiveButton');
            const publishButton = document.getElementById('publishButton');

            // Add click event listener to the move to archive button
            archiveButton.addEventListener('click', function() {
                // Form Validation
                var validateStatus = validateForm();
                console.log(validateStatus);

                if (validateStatus) {
                    var selectElement = document.getElementById('subjectKeyword');
                    var selectedValues = Array.from(selectElement.selectedOptions).map(option => option.value);

                    var uploadedFileName = document.getElementById("uploaded-file-name")?.value || "";
                    var file = uploadedFileName ? "http://localhost/Technology-innovation/client-records/" + uploadedFileName : "";

                    $.ajax({
                        url: 'createUpload.php',
                        method: 'POST',
                        data: {
                            file_name: document.getElementById("uploaded-file-name")?.value || "",
                            file: file,
                            contributor: document.getElementById("contributor")?.value || "",
                            coverage: document.getElementById("coverage")?.value || "",
                            creator: document.getElementById("creator")?.value || "",
                            date: document.getElementById("date")?.value || "",
                            description: document.getElementById("description")?.value || "",
                            format: document.getElementById("format")?.value || "",
                            identifier: document.getElementById("identifier")?.value || "",
                            language: document.getElementById("language")?.value || "",
                            publisher: document.getElementById("publisher")?.value || "",
                            relation: document.getElementById("relation")?.value || "",
                            rights: document.getElementById("rights")?.value || "",
                            source: document.getElementById("source")?.value || "",
                            title: document.getElementById("recordName")?.value || "",
                            upload_status: 3,
                            template_name: document.getElementById("documentType")?.value || "",
                            subject: selectedValues,
                        },
                        success: function(response) {
                            // Handle the AJAX success response
                            console.log(response);

                            window.location.href = "admin_portal_records.php?movetoarchivesuccess=true";
                        },
                        error: function(error) {
                            // Handle the AJAX error
                            console.log(error);
                        }
                    });
                }
            });

            // Add click event listener to the publish button
            publishButton.addEventListener('click', function() {
                // Form Validation
                var validateStatus = validateForm();
                console.log(validateStatus);

                if (validateStatus) {
                    var selectElement = document.getElementById('subjectKeyword');
                    var selectedValues = Array.from(selectElement.selectedOptions).map(option => option.value);

                    var uploadedFileName = document.getElementById("uploaded-file-name")?.value || "";
                    var file = uploadedFileName ? "http://localhost/Technology-innovation/client-records/" + uploadedFileName : "";

                    $.ajax({
                        url: 'createUpload.php',
                        method: 'POST',
                        data: {
                            file_name: document.getElementById("uploaded-file-name")?.value || "",
                            file: file,
                            contributor: document.getElementById("contributor")?.value || "",
                            coverage: document.getElementById("coverage")?.value || "",
                            creator: document.getElementById("creator")?.value || "",
                            date: document.getElementById("date")?.value || "",
                            description: document.getElementById("description")?.value || "",
                            format: document.getElementById("format")?.value || "",
                            identifier: document.getElementById("identifier")?.value || "",
                            language: document.getElementById("language")?.value || "",
                            publisher: document.getElementById("publisher")?.value || "",
                            relation: document.getElementById("relation")?.value || "",
                            rights: document.getElementById("rights")?.value || "",
                            source: document.getElementById("source")?.value || "",
                            title: document.getElementById("recordName")?.value || "",
                            upload_status: 2,
                            template_name: document.getElementById("documentType")?.value || "",
                            subject: selectedValues,
                        },
                        success: function(response) {
                            // Handle the AJAX success response
                            console.log(response);

                            window.location.href = "admin_portal_records.php?publishsuccess=true";
                        },
                        error: function(error) {
                            // Handle the AJAX error
                            console.log(error);
                        }
                    });
                }
            });

            // default upload area setting
            $('#drop-area').show();
            $('#uploaded-area').hide();

            const dropZone = document.getElementById('drop-area');
            const browseBtn = document.getElementById('browse-btn');
            const fileInput = document.getElementById('file-input');
            const deleteBtn = document.getElementById('basic-addon2');

            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('drag-over');
            });

            dropZone.addEventListener('dragleave', (e) => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
            });

            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
                const file = e.dataTransfer.files[0];
                handleFile(file);
            });

            browseBtn.addEventListener('click', (e) => {
                e.preventDefault();
                fileInput.click();
            });

            fileInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                handleFile(file);
            });

            deleteBtn.addEventListener('click', (e) => {
                e.preventDefault();
                $('#drop-area').show();
                $('#uploaded-area').hide();
                filePreview.firstChild.setAttribute('src', '');
            });

            // Get keyword list
            getKeywordList();

            // Get document type list
            getDropdownList()
        });

        function handleFile(file) {
            // check file type
            const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
            if (!allowedTypes.includes(file.type)) {
                alert('Invalid file type. Please upload a JPEG, PNG, or PDF file.');
                return;
            }
            $('#drop-area').hide();
            $('#uploaded-area').show();
            // Do something with the file, like upload it to a server
            console.log(file);
            var reader = new FileReader();
            reader.onload = function(event) {
                $('#uploaded-file-name').val(file.name);
                var thumbnail = '<div class="col-lg-4 mb-4"><div class="card"><img class="card-img-top" src="' + event.target.result + '"></div></div>';
                $('#filePreview').html(thumbnail);
            };
            reader.readAsDataURL(file);
        }

        function getDropdownList() {
            var documentTypeList = document.getElementById("documentType");

            var getdocumentTypeList = $.ajax({
                url: 'getTemplates.php',
                method: 'GET',
                success: function(response) {
                    // Handle the AJAX success response
                    console.log(response);

                    response.templates.forEach(template => {
                        // console.log(template .template_name);
                        var documentTypeOption = document.createElement("option");
                        documentTypeOption.text = template.template_name;
                        documentTypeOption.value = template.template_name;
                        documentTypeList.add(documentTypeOption);
                    });
                }
            });
        }

        function getKeywordList() {
            var keywordList = document.getElementById("subjectKeyword");
            var getKeywordList = $.ajax({
                url: 'getKeyword.php',
                method: 'GET',
                success: function(response) {
                    // Handle the AJAX success response
                    console.log(response);

                    // Get the subjectKeyword and create dropdown options
                    var keywordListOptions = response.data;

                    for (var i = 0; i < keywordListOptions.length; i++) {
                        var keywordListOption = document.createElement("option");
                        keywordListOption.text = keywordListOptions[i];
                        keywordListOption.value = keywordListOptions[i];
                        keywordList.add(keywordListOption);
                    }

                    MultiselectDropdown(window.MultiselectDropdownOptions);
                },
                error: function(error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });
        }

        function generateForm() {
            var documentType = document.getElementById("documentType").value;
            var container = document.getElementById('container');
            container.innerHTML = "";

            $.ajax({
                url: 'getFields.php',
                method: 'GET',
                data: {
                    template_name: documentType
                },
                success: function(response) {
                    // Handle the AJAX success response
                    console.log(response);

                    response.fields.forEach(field => {

                        // Skip creating the field if it already exists
                        if (document.getElementById(field.name)) {
                            return;
                        }

                        var divElement = document.createElement('div');
                        divElement.classList.add('mb-4');

                        switch (field.name) {
                            case 'contributor':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'contributor');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == 1) {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'contributor');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'coverage':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'coverage');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == 1) {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'coverage');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'creator':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'creator');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == 1) {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'creator');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'date':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'date');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == "1") {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'date');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'date');
                                inputElement.setAttribute('placeholder', 'DD/MM/YYYY');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'description':
                                divElement.classList.add('col-lg-12', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'description');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == "1") {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var textareaElement = document.createElement('textarea');
                                textareaElement.classList.add('form-control');
                                textareaElement.setAttribute('id', 'description');
                                textareaElement.setAttribute('placeholder', '');
                                textareaElement.setAttribute('rows', '10');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(textareaElement);
                                break;
                            case 'format':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'format');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == "1") {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'format');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'identifier':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'identifier');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == "1") {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'identifier');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'language':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'language');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == "1") {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'language');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'publisher':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'publisher');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == "1") {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'publisher');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'relation':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'relation');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == "1") {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'relation');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'rights':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'rights');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == "1") {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'rights');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            case 'source':
                                divElement.classList.add('col-lg-6', 'mb-4');
                                var labelElement = document.createElement('label');
                                labelElement.setAttribute('for', 'source');
                                labelElement.classList.add('form-label');
                                labelElement.textContent = field.title + ' ';

                                if (field.is_required == "1") {
                                    var spanElement = document.createElement('span');
                                    spanElement.classList.add('mandatoryField');
                                    spanElement.textContent = '*';

                                    labelElement.appendChild(spanElement);
                                }

                                var inputElement = document.createElement('input');
                                inputElement.setAttribute('type', 'text');
                                inputElement.classList.add('form-control');
                                inputElement.setAttribute('id', 'source');
                                inputElement.setAttribute('placeholder', '');

                                divElement.appendChild(labelElement);
                                divElement.appendChild(inputElement);
                                break;
                            default:
                                break;
                        }
                        container.appendChild(divElement);
                    });

                },
                error: function(error) {
                    // Handle the AJAX error
                    console.log(error);
                }
            });
        }

        function toTitleCase(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        function validateForm() {
            var recordName = document.getElementById("recordName").value;
            var documentType = document.getElementById("documentType").value;
            var fileInput = document.getElementById("uploaded-file-name").value;
            var subjectKeywords = document.getElementById("subjectKeyword").options;
            var container = document.getElementById('container');
            var mandatoryFields = container.getElementsByClassName('mandatoryField');
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

            // Check if record name is empty
            if (recordName.trim() === "") {
                createToast('Record name is required');
                isValid = false;
                console.log("invalid7");
            }

            // Check if document type is not selected
            if (documentType === "") {
                createToast('Please select document type');
                isValid = false;
                console.log("invalid6");
            }

            // Check if file input is empty
            if (fileInput === "") {
                createToast('File upload is required');
                isValid = false;
                console.log("invalid5");
            }

            // Check if at least one subject keyword is selected
            var selectedKeywords = Array.from(subjectKeywords)
                .filter((option) => option.selected)
                .map((option) => option.value);
            if (selectedKeywords.length === 0) {
                createToast('Please select at least one subject keyword');
                isValid = false;
                console.log("invalid4");
            }

            for (var i = 0; i < mandatoryFields.length; i++) {
                var field = mandatoryFields[i];
                var inputElement = field.parentNode.nextElementSibling;

                console.log(field);
                console.log(inputElement);

                // Check if the inputElement exists before accessing its properties
                if (inputElement) {
                    // Check if the input element is a textarea or a text input
                    if (inputElement.tagName.toLowerCase() === 'textarea' || inputElement.type === 'text') {
                        if (!inputElement.value) {
                            var inputIdTitleCase = toTitleCase(inputElement.id);
                            createToast('Please enter ' + inputIdTitleCase);
                            isValid = false;
                            console.log("invalid1");
                        }
                    }

                    // Check if the input element is a date input
                    if (inputElement.type === 'date') {
                        if (!inputElement.valueAsDate) {
                            createToast('Date format is invalid');
                            isValid = false;
                            console.log("invalid2");
                        }
                    }

                    // Check if the input element is a select element
                    if (inputElement.tagName.toLowerCase() === 'select') {
                        if (!inputElement.value) {
                            createToast('Input value is not valid');
                            isValid = false;
                            console.log("invalid3");
                        }
                    }
                }
            }

            return isValid;
        }
    </script>
</body>


</html>