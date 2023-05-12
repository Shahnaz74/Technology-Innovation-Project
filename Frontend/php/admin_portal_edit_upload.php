<?php include 'head.php'; ?>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <!-- Topnav -->
            <?php include 'header.php' ?>

            <div class="container-fluid">

                <?php 
                    // Retrieve the record ID from the query parameter
                    $currentUploadId = $_GET['id'];

                    // Fetch the record from the database using the ID
                    $getUpload = "SELECT uu.upload_id, uu.template_id, uu.file_name, uu.file, uu.contributor, uu.coverage, uu.creator, uu.date, uu.description, uu.format, uu.identifier, uu.language, uu.publisher, uu.relation, uu.rights, uu.source, uu.title, uu.first_name, uu.last_name, uu.email, uu.upload_status,uu.created, t.template_name, GROUP_CONCAT(DISTINCT k.keyword SEPARATOR ',') AS subject
                    FROM user_uploads AS uu
                    JOIN template AS t ON uu.template_id = t.template_id
                    LEFT JOIN keyword_upload AS ku ON uu.upload_id = ku.upload_id
                    LEFT JOIN keyword AS k ON ku.keyword_id = k.keyword_id
                    WHERE uu.upload_id = $currentUploadId";

                    // Execute query and get results
                    $getUploadResult = $conn->query($getUpload);

                    // Check for errors
                    if (!$getUploadResult) {
                        http_response_code(400);
                        die("An error occurred while retrieving data: " . $conn->error);
                    }
                ?>

                <!-- Page header -->
                <header id="form-header" class="row mx-0 mb-4 sticky-top">
                    <div class="col-lg d-flex">
                        <h1 class="h3 primary-red">Edit Upload</h1>
                    </div>
                    <div class="col-lg-auto">
                    <form method="post">
                        <!-- Move to archive button -->
                        <button type="submit" id="moveToArchive" name="moveToArchive" class="btn btn-outline-primary me-2"><i
                            class="bi bi-archive-fill pe-2 "></i>Move to Archive
                        </button>

                        <!-- Save & publish button -->
                        <button type="submit" id="publish" name="publish" class="btn btn-primary"><i class="bi bi-check-circle-fill pe-2"></i>Save & Publish</button>
                    </form>
                    </div>
                </header>

                <!-- Page content -->
                <div class="row mx-0">

                    <!-- Uploader details -->
                    <div class="card uploaderDetailsCard mb-4">
                        <div class=" card-body">
                            <h5 class="card-title primary-red serif">Uploader Details</h5>
                            <p class="card-text">
                            <table class="table">
                                <tbody>
                                <?php
                                    // Get the record details
                                    $row = $getUploadResult->fetch_assoc();

                                    // Extract individual row data
                                    extract($row);
                                ?>
                                    <tr>
                                        <th scope="row">Uploader Name</th>
                                        <td><?php echo $first_name . " " . $last_name?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email</th>
                                        <td><?php echo $email?>
                                            <button type="button" class="btn primary-red">
                                            <a href="mailto:<?php echo $email; ?>">
                                                <i class="bi bi-envelope-fill"></i>
                                                Send email</a>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </p>
                        </div>
                    </div>

                    <form class="needs-validation" method="post" action="">
                        <div class="row mb-4">
                            <?php
                                $getUploadResult = $conn->query($getUpload);
                                $uploadFields = $getUploadResult->fetch_assoc();
                                // foreach ($uploadFields as $key => $value) {
                                //     echo "$key: $value<br>";
                                // }

                                $formattedDate = date('Y-m-d', strtotime($date));
                            ?>

                            <!-- File name -->
                            <div class="mb-4">
                                <label for="title" class="form-label">File name</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="" value="<?php echo $uploadFields['title']?>" required>
                                <div class="invalid-feedback">
                                    File name is required
                                </div>
                            </div>

                            <!-- Document type -->
                            <div class="col-lg-6 mb-4">
                                <label for="documentType" class="form-label">Document type</label>
                                <select class="form-select" id="documentType" name="documentType">';
                                    <?php
                                        $getTemplateList = "SELECT * FROM template";
                                        $getTemplateListResult = mysqli_query($conn, $getTemplateList);
                                        $selectedTemplateId = $value;
                                        $selectedTemplateName = "";
                                
                                        // Display options for template selection
                                        while($trow = mysqli_fetch_object($getTemplateListResult)){
                                            $tid = $trow->id;
                                            $templatename = $trow->template_name;

                                            // If the template name is the same as the current value, select it
                                            if ($templatename === $template_name) {
                                                $selectedTemplateName = $templatename;
                                                echo '<option value="' . $tid . '" selected>' . $selectedTemplateName . '</option>';
                                            } else {
                                                echo '<option value="' . $tid . '">' . $templatename . '</option>';
                                            }
                                        }
                                        ?>
                                </select>
                            </div>

                            <!-- WORKING FILE UPLOAD -->
                            <div class="fileUpload container mb-4">
                                <label for="documentType" class="form-label">File upload <span
                                        class="mandatoryField">*</span></label>

                                <!-- Upload file drop area-->
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

                                <!-- Display uploaded file -->
                                <div id="uploaded-area">
                                    <div class="input-group mb-3">
                                        <input id="uploaded-file-name" type="text" class="form-control" placeholder=""
                                            aria-label="" aria-describedby="basic-addon2">
                                        <button class="input-group-text deleteFileUpload" id="basic-addon2">
                                            <i class="bi bi-trash3-fill pe-2"></i>
                                            Delete file
                                        </button>
                                    </div>
                                    <div class="col-4" id="thumbnails">
                                        <!-- <img src="../img/uploadFileDummy.png" class="img-thumbnail" alt="..."> -->
                                    </div>
                                </div>
                            </div>  

                            <!-- File keyword -->
                            <div class="row mb-4">
                                <label class="mb-2" for="fileKeyword">Topic subject</label>
                                <p>
                                    <select id="fileKeyword" name="fileKeyword" class="selectpicker" multiple
                                        multiselect-search="true">
                                        <option>Keyword 1</option>
                                        <option>Keyword 2</option>
                                        <option>Keyword 3</option>
                                        <option>Keyword 4</option>
                                        <option>Keyword 5</option>
                                        <option>Keyword 6</option>
                                        <option>Keyword 7</option>
                                        <option>Keyword 8</option>
                                        <option>Keyword 9</option>
                                        <option>Keyword 10</option>
                                    </select>
                                </p>
                            </div>

                            <div class="row mb-4">
                                <!-- Publisher -->
                                <div class="col-lg-6">
                                    <label for="publisher" class="form-label">Publisher </label>
                                    <input type="text" class="form-control" id="publisher" name="publisher" placeholder="" value="<?php echo $uploadFields['publisher']?>" required>
                                </div>

                                <!-- Identifier -->
                                <div class="col-lg-6">
                                    <label for="identifier" class="form-label">Identifier </label>
                                    <input type="text" class="form-control" id="identifier" name="identifier" placeholder="" value="<?php echo $uploadFields['identifier']?>" required>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Date -->
                                <div class="col-lg-6">
                                    <label for="date" class="form-label">Date </label>
                                    <input type="text" class="form-control" id="date" name="date" placeholder="" value="<?php echo $formattedDate?>" required>
                                </div>

                                <!-- Contributor -->
                                <div class="col-lg-6">
                                    <label for="contributor" class="form-label">Contributor </label>
                                    <input type="text" class="form-control" id="contributor" name="contributor" placeholder="" value="<?php echo $uploadFields['contributor']?>" >
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Source -->
                                <div class="col-lg-6">
                                    <label for="source" class="form-label">Source </label>
                                    <input type="text" class="form-control" id="source" name="source" placeholder="" value="<?php echo $uploadFields['source']?>">
                                </div>

                                <!-- Creator -->
                                <div class="col-lg-6">
                                    <label for="creator" class="form-label">Creator </label>
                                    <input type="text" class="form-control" id="creator" name="creator" placeholder="" value="<?php $creator?>">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Coverage -->
                                <div class="col-lg-6">
                                    <label for="coverage" class="form-label">Coverage </label>
                                    <input type="text" class="form-control" id="coverage" name="coverage" placeholder="" value="<?php echo $uploadFields['coverage']?>">
                                </div>

                                <!-- Relation -->
                                <div class="col-lg-6">
                                    <label for="relation" class="form-label">Relation </label>
                                    <input type="text" class="form-control" id="relation" name="relation" placeholder="" value="<?php $relation?>">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Rights -->
                                <div class="col-lg-6">
                                    <label for="rights" class="form-label">Rights </label>
                                    <input type="text" class="form-control" id="rights" name="rights" placeholder="" value="<?php echo $uploadFields['rights']?>">
                                </div>

                                <!-- Language -->
                                <div class="col-lg-6">
                                    <label for="language" class="form-label">Language </label>
                                    <input type="text" class="form-control" id="language" name="language" placeholder="" value="<?php echo $uploadFields['language']?>">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="10" placeholder=""><?php echo $uploadFields['description']; ?></textarea>
                                </div>
                            </div>
                    </form>

                    <!-- <form method="post" action="">
                        <label for="coverage">Coverage:</label>
                        <input type="text" name="coverage" id="coverage">
                        <label for="contributor">Contributor:</label>
                        <input type="text" name="contributor" id="contributor">
                        <input type="submit" value="Update">
                    </form> -->

                    <?php
                        if (isset($_POST['moveToArchive'])){
                            if (isset($_POST['coverage']) || isset($_POST['contributor'])) {
                                $coverage = $_POST['coverage'];
                                $contributor = $_POST['contributor']; 
                            
                                // print_r($_POST);
                                // prepare the query with placeholders
                                $sql = "UPDATE user_uploads SET 
                                    `coverage`='$coverage',
                                    `contributor`='$contributor'
                                    WHERE upload_id=1";
                            
                                $update = mysqli_query($conn, $sql);
                            
                                // execute the statement
                                if($update){
                                    $_SESSION['message'] = "Upload published successfully";
                                    // header('Location:admin_portal_uploads.php');
                                    exit();
                                }else{
                                    $_SESSION['error'] = "Upload publish failed.";
                                }
                            }
                        }
                    ?>  
                </div>
            </div>
        </div>
    </div>

    <?php include 'script.php' ?>

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
                    var thumbnail = '<div class="col-md-4 mb-4"><div class="card"><img class="card-img-top" src="' + event.target.result + '"></div></div>';
                    $('#thumbnails').html(thumbnail);
                };
                reader.readAsDataURL(file);
            }

            // Get keyword list
            $.ajax({
                url: './get_keywords.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.status == 200) {
                        var options = '';
                        $.each(data.data, function(index, value) {
                            options += '<option>' + value + '</option>';
                        });
                        $('#fileKeyword').html(options);
                        $('#fileKeyword').selectpicker('refresh');
                    } else {
                        alert(data.error);
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    alert('An error occurred while fetching data from the server: ' + errorThrown);
                }
            });
        });
    </script>
</body>
</html>