<?php include 'head.php'; ?>

<body id="page-top">
    <div class="wrapper">

        <!-- Sidebar  -->
        <?php include 'sidebar.php'; ?>

        <!-- Page Content  -->
        <div id="content">

            <!-- Topnav -->
            <?php include 'admin_header.php' ?>

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

                <!-- Page content -->
                <div class="row mx-0">

                    <?php
                    if (isset($_POST['moveToArchive']) || isset($_POST['moveToPending']) || isset($_POST['publish'])) {
                        $currentUploadId = $_GET['id'];
                        $title = $_POST['title'];
                        $publisher = $_POST['publisher'];
                        $identifier = $_POST['identifier'];
                        $date = $_POST['date'];
                        $contributor = $_POST['contributor'];
                        $source = $_POST['source'];
                        $creator = $_POST['creator'];
                        $coverage = $_POST['coverage'];
                        $relation = $_POST['relation'];
                        $rights = $_POST['rights'];
                        $language = $_POST['language'];
                        $description = $_POST['description'];

                        // Store keywords to DB
                        if (isset($_POST['uploadKeyword'])) {
                            $uploadKeywordArr = $_POST['uploadKeyword'];

                            foreach ($uploadKeywordArr as $keyword_id) {
                                $sql = "SELECT * FROM keyword_upload WHERE upload_id = '$currentUploadId' AND keyword_id = '$keyword_id'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) == 0) {
                                    $sql = "INSERT INTO keyword_upload (upload_id, keyword_id) VALUES ('$currentUploadId', '$keyword_id')";
                                    $update = mysqli_query($conn, $sql);
                                }
                            }
                        }

                        // Set the upload status based on which button was pressed
                        if (isset($_POST['moveToArchive'])) {
                            $upload_status = 3;
                        } elseif (isset($_POST['moveToPending'])) {
                            $upload_status = 1;
                        } elseif (isset($_POST['publish'])) {
                            $upload_status = 2;
                        }

                        $sql = "UPDATE user_uploads SET
                            upload_status = $upload_status, 
                            `title`='$title',
                            `publisher`='$publisher',
                            `identifier`='$identifier',
                            `date`='$date',
                            `contributor`='$contributor',
                            `source`='$source',
                            `creator`='$creator',
                            `coverage`='$coverage',
                            `relation`='$relation',
                            `rights`='$rights',
                            `language`='$language',
                            `description`='$description'
                            WHERE upload_id=$currentUploadId";

                        $update = mysqli_query($conn, $sql);

                        if ($update) {
                            // Check that no output was sent before the header function call
                            if (!headers_sent()) {
                                header('Location:admin_portal_uploads.php');
                                exit();
                            } else {
                                // Handle error if headers were already sent
                                echo "Headers already sent. Please <a href='admin_portal_uploads.php'>click here</a> to continue.";
                                exit();
                            }
                        } else {
                            // $_SESSION['error'] = "Upload publish failed.";
                        }
                    }
                    ?>

                    <form method="post">
                        <!-- Page header -->

                        <?php
                        // Get the record details
                        $row = $getUploadResult->fetch_assoc();

                        // Extract individual row data
                        extract($row);
                        ?>

                        <header id="form-header" class="row mx-0 my-4 sticky-top">
                            <div class="col-lg d-flex">
                                <h1 class="h3 primary-red">Edit Upload</h1>
                            </div>
                            <div class="col-lg-auto">
                                <?php if ($upload_status == 1) {
                                    // Move to archive button
                                    echo '<button type="submit" id="moveToArchive" name="moveToArchive"
                                    class="btn btn-outline-primary me-2"><i class="bi bi-archive-fill pe-2 "></i>Move to
                                    Archive
                                    </button>';
                                } elseif ($upload_status == 3) {
                                    // Move to pending button
                                    echo '<button type="submit" id="moveToPending" name="moveToPending"
                                    class="btn btn-outline-primary me-2"><i class="bi bi-archive-fill pe-2 "></i>Move to
                                    Pending
                                    </button>';
                                }
                                ?>

                                <!-- Save & publish button -->
                                <button type="submit" id="publish" name="publish" class="btn btn-primary"><i
                                        class="bi bi-check-circle-fill pe-2"></i>Save & Publish</button>
                            </div>
                        </header>

                        <!-- Uploader details -->
                        <div class="card uploaderDetailsCard mb-4">
                            <div class=" card-body">
                                <h5 class="card-title primary-red serif">Uploader Details</h5>
                                <p class="card-text">
                                <table class="table">
                                    <tbody>

                                        <tr>
                                            <th scope="row">Uploader Name</th>
                                            <td>
                                                <?php echo $first_name . " " . $last_name ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td>
                                                <?php echo $email ?>
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
                                <input type="text" class="form-control" id="title" name="title" placeholder=""
                                    value="<?php echo $uploadFields['title'] ?>">
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
                                    while ($trow = mysqli_fetch_object($getTemplateListResult)) {
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
                            <!-- File upload -->
                            <div class="fileUpload container mb-4">
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
                                    <div class="col-4" id="thumbnails">
                                        <!-- <img src="../img/uploadFileDummy.png" class="img-thumbnail" alt="..."> -->
                                    </div>
                                </div>
                            </div>

                            <!-- File keyword -->
                            <div class="mb-4">
                                <label class="mb-2" for="fileKeyword">Topic subject</label>
                                <p>
                                    <?php
                                    // Execute the first query to get the $keywords array.
                                    $get_keywords_query = "SELECT keyword FROM keyword 
    INNER JOIN keyword_upload ON keyword.keyword_id = keyword_upload.keyword_id 
    WHERE keyword_upload.upload_id = '$currentUploadId'";
                                    $get_keywords_result = mysqli_query($conn, $get_keywords_query);
                                    $keywords = array();
                                    while ($row = mysqli_fetch_assoc($get_keywords_result)) {
                                        $keywords[] = $row['keyword'];
                                    }

                                    // Execute the second query to get the $keywordOptions array.
                                    $getKeyword = "SELECT * FROM keyword";
                                    $getKeywordResult = $conn->query($getKeyword);
                                    $keywordOptions = array();
                                    while ($option = $getKeywordResult->fetch_assoc()) {
                                        $option_value = $option['keyword_id'];
                                        $option_label = $option['keyword'];
                                        $selected = '';
                                        if (in_array($option_label, $keywords)) {
                                            $selected = 'selected';
                                        }
                                        $keywordOptions[] = array(
                                            'id' => $option_value,
                                            'label' => $option_label,
                                            'selected' => $selected
                                        );
                                    }
                                    ?>

                                    <!-- Use a loop to generate the select options with the selected attribute. -->
                                    <select id="uploadKeyword" name="uploadKeyword[]" class="selectpicker" multiple
                                        multiselect-search="true">
                                        <?php foreach ($keywordOptions as $option): ?>
                                            <option id="<?php echo $option['id']; ?>" value="<?php echo $option['id']; ?>"
                                                <?php echo $option['selected']; ?>>
                                                <?php echo $option['label']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>

                                </p>
                            </div>

                            <div class="row mb-4">
                                <!-- Publisher -->
                                <div class="col-lg-6">
                                    <label for="publisher" class="form-label">Publisher </label>
                                    <input type="text" class="form-control" id="publisher" name="publisher"
                                        placeholder="" value="<?php echo $uploadFields['publisher'] ?>">
                                </div>

                                <!-- Identifier -->
                                <div class="col-lg-6">
                                    <label for="identifier" class="form-label">Identifier </label>
                                    <input type="text" class="form-control" id="identifier" name="identifier"
                                        placeholder="" value="<?php echo $uploadFields['identifier'] ?>">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Date -->
                                <div class="col-lg-6">
                                    <label for="date" class="form-label">Date </label>
                                    <input type="text" class="form-control" id="date" name="date" placeholder=""
                                        value="<?php echo $formattedDate ?>">
                                </div>

                                <!-- Contributor -->
                                <div class="col-lg-6">
                                    <label for="contributor" class="form-label">Contributor </label>
                                    <input type="text" class="form-control" id="contributor" name="contributor"
                                        placeholder="" value="<?php echo $uploadFields['contributor'] ?>">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Source -->
                                <div class="col-lg-6">
                                    <label for="source" class="form-label">Source </label>
                                    <input type="text" class="form-control" id="source" name="source" placeholder=""
                                        value="<?php echo $uploadFields['source'] ?>">
                                </div>

                                <!-- Creator -->
                                <div class="col-lg-6">
                                    <label for="creator" class="form-label">Creator </label>
                                    <input type="text" class="form-control" id="creator" name="creator" placeholder=""
                                        value="<?php $uploadFields['creator'] ?>">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Coverage -->
                                <div class="col-lg-6">
                                    <label for="coverage" class="form-label">Coverage </label>
                                    <input type="text" class="form-control" id="coverage" name="coverage" placeholder=""
                                        value="<?php echo $uploadFields['coverage'] ?>">
                                </div>

                                <!-- Relation -->
                                <div class="col-lg-6">
                                    <label for="relation" class="form-label">Relation </label>
                                    <input type="text" class="form-control" id="relation" name="relation" placeholder=""
                                        value="<?php $uploadFields['relation'] ?>">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <!-- Rights -->
                                <div class="col-lg-6">
                                    <label for="rights" class="form-label">Rights </label>
                                    <input type="text" class="form-control" id="rights" name="rights" placeholder=""
                                        value="<?php echo $uploadFields['rights'] ?>">
                                </div>

                                <!-- Language -->
                                <div class="col-lg-6">
                                    <label for="language" class="form-label">Language </label>
                                    <input type="text" class="form-control" id="language" name="language" placeholder=""
                                        value="<?php echo $uploadFields['language'] ?>">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="row mb-4">
                                <div class="col-lg-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="10"
                                        placeholder=""><?php echo $uploadFields['description']; ?></textarea>
                                </div>
                            </div>

                            <h1>TESTING</h1>

                            <?php
                            $getUploadResult = $conn->query($getUpload);
                            $uploadFields = $getUploadResult->fetch_assoc();
                            // foreach ($uploadFields as $key => $value) {
                            //     echo "$key: $value<br>";
                            // }
                            
                            $formattedDate = date('Y-m-d', strtotime($date));

                            // Move 'file_name' to the first position of the array
                            $title = $uploadFields['title'];
                            unset($uploadFields['title']);
                            $uploadFields = array_slice($uploadFields, 0, 0, true) +
                                ['title' => $title] +
                                array_slice($uploadFields, 0, count($uploadFields), true);

                            // Move 'template_name' to the second position of the array
                            $template_name = $uploadFields['template_name'];
                            unset($uploadFields['template_name']);
                            $uploadFields = array_slice($uploadFields, 0, 1, true) +
                                ['template_name' => $template_name] +
                                array_slice($uploadFields, 1, count($uploadFields) - 1, true);

                            // Skip fields with keys in the $keysToSkip array
                            $keysToSkip = array('upload_id', 'file_name', 'template_id', 'format', 'first_name', 'last_name', 'email', 'upload_status', 'created', 'subject');

                            foreach ($uploadFields as $key => $value) {
                                if (in_array($key, $keysToSkip)) {
                                    continue;
                                }

                                // Full row setting
                                echo '<div class="' . (($key === 'title' || $key === 'description' || $key === 'file') ? 'mb-4' : 'col-lg-6 mb-4') . '">';

                                // Description
                                if ($key === 'description') {
                                    echo '<label for="' . $key . '" class="form-label">' . ucfirst($key) . '</label>';
                                    echo '<textarea class="form-control" rows="10" id="' . $key . '">' . $value . '</textarea>';

                                }
                                // Date
                                elseif ($key === 'date') {
                                    echo '<label for="' . $key . '" class="form-label">' . ucfirst($key) . '</label>';
                                    echo '<input type="text" class="form-control col-lg-6" id="' . $key . '" value="' . $formattedDate . '" placeholder="" />';
                                    echo '<small class="form-text text-muted">Date format: YYYY-MM-DD</small>';

                                }
                                // File name
                                elseif ($key === 'title') {
                                    echo '<label for="fileName" class="form-label">File name <span class="mandatoryField">*</span></label>';
                                    echo '<input type="text" class="form-control" id="fileName" placeholder="" value="' . $value . '">';
                                    echo '<div class="invalid-feedback">File name is required</div>';

                                }
                                // Document type
                                elseif ($key === 'template_name') {
                                    echo '<label for="documentType" class="form-label">Document type</label>
                                              <select class="form-select" id="documentType" name="documentType">';

                                    $getTemplateList = "SELECT * FROM template";
                                    $getTemplateListResult = mysqli_query($conn, $getTemplateList);
                                    $selectedTemplateId = $value;
                                    $selectedTemplateName = "";

                                    // Display options for template selection
                                    while ($trow = mysqli_fetch_object($getTemplateListResult)) {
                                        $tid = $trow->id;
                                        $templatename = $trow->template_name;
                                        // If the template name is the same as the current value, select it
                                        if ($templatename === $value) {
                                            $selectedTemplateName = $templatename;
                                            echo '<option value="' . $tid . '" selected>' . $selectedTemplateName . '</option>';
                                        } else {
                                            echo '<option value="' . $tid . '">' . $templatename . '</option>';
                                        }
                                    }

                                    echo '</select>
                                              <div class="invalid-feedback">Please select document type.</div>';
                                }

                                // Other fields
                                else {
                                    echo '<label for="' . $key . '" class="form-label">' . ucfirst($key) . '</label>';
                                    echo '<input type="text" class="form-control" id="' . $key . '" name="' . $key . '"';
                                    if (empty($value)) {
                                        echo ' value=""';
                                    } else {
                                        echo ' value="' . $value . '"';
                                    }
                                    echo ' placeholder="">';
                                }
                                echo '</div>';
                            }
                            ?>
                    </form>
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
                    var thumbnail = '<div class="col-lg-4 mb-4"><div class="card"><img class="card-img-top" src="' + event.target.result + '"></div></div>';
                    $('#thumbnails').html(thumbnail);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>