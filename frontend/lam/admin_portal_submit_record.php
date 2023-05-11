<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Submit Record</title>

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

    <script>
      
    </script>
</head>

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

                <header id="form-header" class="row mx-0 mb-4 sticky-top">
                  <div class="col-lg d-flex">
                    <h1 class="h3 primary-red">New Record</h1>
                  </div>
                  <div class="col-lg-auto">
                    <button type="button" class="btn btn-outline-primary me-2"><i class="bi bi-archive-fill pe-2"></i>Save to Archive</button>
                    <button type="button" id="publishButton" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Publish</button>
                  </div>
                </header>

                <!-- Page content -->
                <div class="row mx-0">
                    <form class="needs-validation" novalidate>

                        <!-- File name -->
                        <div class="mb-4">
                            <label for="fileName" class="form-label">File name <span
                                    class="mandatoryField">*</span></label>
                            <input type="text" class="form-control" id="fileName" placeholder="" required>
                            <div class="invalid-feedback">
                                File name is required
                            </div>
                        </div>

                        <!-- Document type -->
                        <div class="col-md-3 mb-4">
                            <label for="template-select" class="form-label">Document type</label>
                            <select class="form-select" id="template-select" name="template_name" required>
                                <option selected disabled value="">Choose...</option>
                                <?php
                                    // Call getTemplates.php to retrieve the templates
                                    $url = 'http://localhost/TIP/backend/templates/getTemplates.php';
                                    $json = file_get_contents($url);
                                    $templates = json_decode($json, true);

                                    // Populate the dropdown select with the template names
                                    foreach ($templates['templates'] as $template) {
                                      echo '<option value="' . $template['template_name'] . '">' . $template['template_name'] . '</option>';
                                    }
                                ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select document type.
                            </div>
                        </div>

                        <!-- File upload -->
                        <div class="fileUpload container mb-4 px-0">
                            <label for="documentType" class="form-label">File upload <span
                                    class="mandatoryField">*</span></label>
                            <!-- Upload file area -->
                            <div id="drop-area" class="col-md-6 col-md-offset-3 py-5">
                                <img src="../img/fileUpload.svg" class="pb-2" alt="">
                                <h5 id="drop-hint" class="serif pb-2">Drag & drop files or <a href="#"
                                        id="browse-btn">Browse</a></h5>
                                <p id="drop-subhint">Supported formats: JPEG, PNG, PDF</p>
                                <input type="file" id="file-input" accept=".jpg, .jpeg, .png, .pdf"
                                    style="display:none;">
                                <p id="drop-subhint" class="primary-red">File size limit: 2MB</p>
                                <!-- <div class="row" id="thumbnails"></div> -->
                            </div>
                            <!-- Uploaded file area -->
                            <div id="uploaded-area">
                                <div class="input-group mb-3">
                                    <input id="uploaded-file-name" type="text" class="form-control" placeholder=""
                                        aria-label="" aria-describedby="basic-addon2">
                                    <button class="input-group-text deleteFileUpload" id="basic-addon2">
                                        <i class="bi bi-trash3-fill pe-2"></i>
                                        Delete file
                                    </button>
                                </div>
                                <div class="col-6" id="thumbnails">
                                    <!-- <img src="../img/uploadFileDummy.png" class="img-thumbnail" alt="..."> -->
                                </div>
                            </div>
                        </div>

                        <!-- File keyword -->
                        <div class="mb-4">
                            <label class="mb-2" for="fileKeyword">Topic subject</label>
                            <p>
                                <select id="fileKeyword" name="keyword" class="selectpicker" multiple
                                    multiselect-search="true">
                                    <?php
                                    // Call getTemplates.php to retrieve the templates
                                    $url = 'http://localhost/TIP/backend/keyword/getKeyword.php';
                                    $json = file_get_contents($url);
                                    $keywords = json_decode($json, true);

                                    // Populate the dropdown select with the template names
                                    foreach ($keywords['data'] as $keyword) {
                                      echo '<option value="' . $keyword . '">' . $keyword . '</option>';
                                    }
                                ?>
                                </select>
                            </p>
                        </div>
                        <div class="row">
                         <div id="form-fields"></div>
                        </div>
                        <div class="row">
                            <!-- Author first name -->
                            <div class="col-lg-6 mb-4">
                                <label for="first-name" class="form-label">First Name</label><span
                                        class="mandatoryField">*</span>
                                <input type="text" class="form-control" id="first-name" name= "first-name" placeholder="">
                                <div class="invalid-feedback">
                                First name is required
                                </div>
                            </div>

                            <!-- Author last name -->
                            <div class="col-lg-6 mb-4">
                                <label for="last-name" class="form-label">Last Name</label><span
                                        class="mandatoryField">*</span>
                                <input type="text" class="form-control" id="last-name" name= "last-name" placeholder="">
                                <div class="invalid-feedback">
                                Last name is required
                                </div>
                            </div>

                            <!-- Author email -->
                            <div class="col-lg-6 mb-4">
                                <label for="email" class="form-label">Email <span
                                        class="mandatoryField">*</span></label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="">
                                <div class="invalid-feedback">
                                Email is required
                                </div>
                            </div>
                        </div>
                    </form>
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
    <!-- File keyword selector script -->
    <script src="../js/multiselect-dropdown.js"></script>

    <!--script for drag and drop-->
    <script>
        $(document).ready(function () {
            $('#drop-area').show();
            $('#uploaded-area').hide();

            const dropZone = document.querySelector('#drop-area');
            const browseBtn = document.querySelector('#browse-btn');
            const fileInput = document.querySelector('#file-input');
            const deleteBtn = document.querySelector('#basic-addon2');

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
                reader.onload = function (event) {
                    $('#uploaded-file-name').val(file.name);
                    var thumbnail = '<div class="mb-4"><div class="card"><img class="card-img-top img-thumbnail" src="' + event.target.result + '"></div></div>';
                    $('#thumbnails').html(thumbnail);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
      // Get the form fields div
      var formFields = document.getElementById("form-fields");

      // Function to create form fields based on the selected template
      function createFormFields(template) {
        // Clear any existing form fields
        formFields.innerHTML = "";

        // Create form fields based on the selected template
        template.fields.forEach(function(field) {
          var fieldWrapper = document.createElement("div");
          fieldWrapper.classList.add("col-lg-6", "mb-4"); // Add the desired Bootstrap classes to the wrapper div

          var label = document.createElement("label");
          label.classList.add("form-label");
          label.innerHTML = field.title + ": ";
          fieldWrapper.appendChild(label);
          
          var input = document.createElement("input");
          input.classList.add("form-control");
          input.setAttribute("type", "text");
          input.setAttribute("id", field.name);
          input.setAttribute("name", field.name);
          input.setAttribute("placeholder", field.placeholder);
          input.setAttribute("required", field.is_required ? "true" : "false");
          
          fieldWrapper.appendChild(input);

          formFields.appendChild(fieldWrapper);
        });
      }

      // Add an event listener to the template select to update the form fields when a template is selected
      var templateSelect = document.getElementById("template-select");
      templateSelect.addEventListener("change", function() {
        // Find the selected template from the retrieved templates
        var selectedTemplateObj = null;
        <?php
          // Convert the PHP templates array to a JavaScript object
          $jsTemplates = json_encode($templates['templates']);
          echo "var templates = " . $jsTemplates . ";";
        ?>

        templates.forEach(function(template) {
          if (template.template_name === templateSelect.value) {
            selectedTemplateObj = template;
          }
        });

        if (selectedTemplateObj) {
          // Create form fields based on the selected template
          createFormFields(selectedTemplateObj);
        }
      });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // Add click event listener to the Publish button
        document.getElementById('publishButton').addEventListener('click', function() {
        // Get the input values from the form
        var fileName = document.getElementById('fileName').value;
        var templateName = document.getElementById('template-select').value;
        var firstName = document.getElementById('first-name').value;
        var lastName = document.getElementById('last-name').value;
        var email = document.getElementById('email').value;
        var keywords = Array.from(document.getElementById('fileKeyword').selectedOptions).map(option => option.value);
        var formFieldValues = Array.from(document.querySelectorAll('#form-fields input')).map(input => ({
          name: input.name,
          value: input.value
        }));

    // Prepare the data object
    var data = {
      file_name: fileName,
      template_name: templateName,
      first_name: firstName,
      last_name: lastName,
      email: email,
      subject: keywords,
      form_fields: formFieldValues,
      upload_status: 2 // Set the upload status to 2
    };

    // Create a new XHR object
    var xhr = new XMLHttpRequest();

    // Set the request method and URL
    xhr.open('POST', 'http://localhost/TIP/backend/uploads/createUpload.php', true);

    // Set the request headers
    xhr.setRequestHeader('Content-Type', 'application/json');

    // Set the event handler for the XHR load event
    xhr.onload = function() {
      if (xhr.status === 200) {
        // Request succeeded, handle the response here if needed
        console.log(xhr.responseText);
      } else {
        // Request failed, handle the error here if needed
        console.error('Request failed. Status:', xhr.status);
      }
    };

    // Convert the data object to JSON
    var jsonData = JSON.stringify(data);

    // Send the request with the JSON data
    xhr.send(jsonData);
  });
});

    </script>
</body>


</html>